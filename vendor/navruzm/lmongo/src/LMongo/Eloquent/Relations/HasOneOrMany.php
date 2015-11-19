<?php namespace LMongo\Eloquent\Relations;

use MongoID;
use LMongo\Eloquent\Model;
use LMongo\Eloquent\Builder;
use LMongo\Eloquent\Collection;

abstract class HasOneOrMany extends Relation {

	/**
	 * The foreign key of the parent model.
	 *
	 * @var string
	 */
	protected $foreignKey;

	/**
	 * Create a new has many relationship instance.
	 *
	 * @param  \LMongo\Eloquent\Builder  $query
	 * @param  \LMongo\Eloquent\Model  $parent
	 * @param  string  $foreignKey
	 * @return void
	 */
	public function __construct(Builder $query, Model $parent, $foreignKey)
	{
		$this->foreignKey = $foreignKey;

		parent::__construct($query, $parent);
	}

	/**
	 * Set the base constraints on the relation query.
	 *
	 * @return void
	 */
	public function addConstraints()
	{
		$key = $this->parent->getKey();

		$this->query->where($this->foreignKey, new MongoID((string) $key));
	}

	/**
	 * Set the constraints for an eager load of the relation.
	 *
	 * @param  array  $models
	 * @return void
	 */
	public function addEagerConstraints(array $models)
	{
		$value = $this->getKeys($models);

		$value = array_map(function($value)
			{
				return ($value instanceof MongoID) ? $value : new MongoID($value);
			}, $value);

		$this->query->whereIn($this->foreignKey, $value);
	}

	/**
	 * Match the eagerly loaded results to their single parents.
	 *
	 * @param  array   $models
	 * @param  \LMongo\Eloquent\Collection  $results
	 * @param  string  $relation
	 * @return array
	 */
	public function matchOne(array $models, Collection $results, $relation)
	{
		return $this->matchOneOrMany($models, $results, $relation, 'one');
	}

	/**
	 * Match the eagerly loaded results to their many parents.
	 *
	 * @param  array   $models
	 * @param  \LMongo\Eloquent\Collection  $results
	 * @param  string  $relation
	 * @return array
	 */
	public function matchMany(array $models, Collection $results, $relation)
	{
		return $this->matchOneOrMany($models, $results, $relation, 'many');
	}

	/**
	 * Match the eagerly loaded results to their many parents.
	 *
	 * @param  array   $models
	 * @param  \LMongo\Eloquent\Collection  $results
	 * @param  string  $relation
	 * @param  string  $type
	 * @return array
	 */
	protected function matchOneOrMany(array $models, Collection $results, $relation, $type)
	{
		$dictionary = $this->buildDictionary($results);

		// Once we have the dictionary we can simply spin through the parent models to
		// link them up with their children using the keyed dictionary to make the
		// matching very convenient and easy work. Then we'll just return them.
		foreach ($models as $model)
		{
			$key = $model->getKey();

			if (isset($dictionary[$key]))
			{
				$value = $this->getRelationValue($dictionary, $key, $type);

				$model->setRelation($relation, $value);
			}
		}

		return $models;
	}

	/**
	 * Get the value of a relationship by one or many type.
	 *
	 * @param  array   $dictionary
	 * @param  string  $key
	 * @param  string  $type
	 */
	protected function getRelationValue(array $dictionary, $key, $type)
	{
		$value = $dictionary[$key];

		return $type == 'one' ? reset($value) : $this->related->newCollection($value);
	}

	/**
	 * Build model dictionary keyed by the relation's foreign key.
	 *
	 * @param  \LMongo\Eloquent\Collection  $results
	 * @return array
	 */
	protected function buildDictionary(Collection $results)
	{
		$dictionary = array();

		// First we will create a dictionary of models keyed by the foreign key of the
		// relationship as this will allow us to quickly access all of the related
		// models without having to do nested looping which will be quite slow.
		foreach ($results as $result)
		{
			$dictionary[(string)$result->{$this->foreignKey}][] = $result;
		}

		return $dictionary;
	}

	/**
	 * Attach a model instance to the parent model.
	 *
	 * @param  \LMongo\Eloquent\Model  $model
	 * @return \LMongo\Eloquent\Model
	 */
	public function save(Model $model)
	{
		$model->setAttribute($this->foreignKey, new MongoID($this->parent->getKey()));

		return $model->save() ? $model : false;
	}

	/**
	 * Attach an array of models to the parent instance.
	 *
	 * @param  array  $models
	 * @return array
	 */
	public function saveMany(array $models)
	{
		array_walk($models, array($this, 'save'));

		return $models;
	}

	/**
	 * Create a new instance of the related model.
	 *
	 * @param  array  $attributes
	 * @return \LMongo\Eloquent\Model
	 */
	public function create(array $attributes)
	{
		$foreign = array($this->foreignKey => new MongoID($this->parent->getKey()));

		// Here we will set the raw attributes to avoid hitting the "fill" method so
		// that we do not have to worry about a mass accessor rules blocking sets
		// on the models. Otherwise, some of these attributes will not get set.
		$instance = $this->related->newInstance();

		$instance->setRawAttributes(array_merge($attributes, $foreign));

		$instance->save();

		return $instance;
	}

	/**
	 * Create an array of new instances of the related model.
	 *
	 * @param  array  $records
	 * @return array
	 */
	public function createMany(array $records)
	{
		$instances = array();

		foreach ($records as $record)
		{
			$instances[] = $this->create($record);
		}

		return $instances;
	}

	/**
	 * Perform an update on all the related models.
	 *
	 * @param  array  $attributes
	 * @return int
	 */
	public function update(array $attributes)
	{
		if ($this->related->usesTimestamps())
		{
			$attributes[$this->relatedUpdatedAt()] = $this->related->freshTimestamp();
		}

		return $this->query->update($attributes);
	}

	/**
	 * Get the foreign key for the relationship.
	 *
	 * @return string
	 */
	public function getForeignKey()
	{
		return $this->foreignKey;
	}

}