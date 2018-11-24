<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Institution Model
 *
 * @method \App\Model\Entity\Institution get($primaryKey, $options = [])
 * @method \App\Model\Entity\Institution newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Institution[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Institution|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institution|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Institution patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Institution[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Institution findOrCreate($search, callable $callback = null, $options = [])
 */
class InstitutionTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('institution');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('APROutcome')
            ->maxLength('APROutcome', 500)
            ->allowEmpty('APROutcome');

        $validator
            ->scalar('ApiUrl')
            ->maxLength('ApiUrl', 500)
            ->allowEmpty('ApiUrl');

        $validator
            ->scalar('Country')
            ->maxLength('Country', 500)
            ->allowEmpty('Country');

        $validator
            ->scalar('Name')
            ->maxLength('Name', 500)
            ->allowEmpty('Name');

        $validator
            ->scalar('NumberOfCourses')
            ->maxLength('NumberOfCourses', 500)
            ->allowEmpty('NumberOfCourses');

        $validator
            ->scalar('PUBUKPRN')
            ->maxLength('PUBUKPRN', 500)
            ->allowEmpty('PUBUKPRN');

        $validator
            ->scalar('PUBUKPRNCountry')
            ->maxLength('PUBUKPRNCountry', 500)
            ->allowEmpty('PUBUKPRNCountry');

        $validator
            ->scalar('QAAReportUrl')
            ->maxLength('QAAReportUrl', 500)
            ->allowEmpty('QAAReportUrl');

        $validator
            ->scalar('SortableName')
            ->maxLength('SortableName', 500)
            ->allowEmpty('SortableName');

        $validator
            ->scalar('StudentUnionUrl')
            ->maxLength('StudentUnionUrl', 500)
            ->allowEmpty('StudentUnionUrl');

        $validator
            ->scalar('StudentUnionUrlWales')
            ->maxLength('StudentUnionUrlWales', 500)
            ->allowEmpty('StudentUnionUrlWales');

        $validator
            ->scalar('TEFOutcome')
            ->maxLength('TEFOutcome', 500)
            ->allowEmpty('TEFOutcome');

        $validator
            ->scalar('UKPRN')
            ->maxLength('UKPRN', 500)
            ->allowEmpty('UKPRN');

        return $validator;
    }
}
