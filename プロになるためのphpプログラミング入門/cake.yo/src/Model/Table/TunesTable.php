<?php
namespace App\Model\Table;

use App\Model\Entity\Tune;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tunes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Artists
 * @property \Cake\ORM\Association\BelongsTo $Feelings
 */
class TunesTable extends Table
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

        $this->table('tunes');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Artists', [
            'foreignKey' => 'artist_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Feelings', [
            'foreignKey' => 'feeling_id',
            'joinType' => 'INNER'
        ]);
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
						->add('name', 'length', ['rule' => ['lengthBetween', 1, 20],
																		'message' => '曲名は20文字以内で入力して下さい']);
				$validator
						->add('artist_id', 'range', ['rule' => ['range', 0, 100],
																				'message' => 'アーティストを選択して下さい']);

				$validator
						->add('feeling_id', 'range', ['rule' => ['range', 0, 100],
																				'message' => '気持ちを選択して下さい']);
        $validator
            ->allowEmpty('comcont');

				$validator
						->add('comcont', 'maxlen', ['rule' => ['maxLength', 30],
																				'message' => 'コメントは 30 文字以内で入力して下さい']);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['artist_id'], 'Artists'));
        $rules->add($rules->existsIn(['feeling_id'], 'Feelings'));
        return $rules;
    }

		function findFeeling($feelId = null) {
			if($feelId < 1 || $feelId > 6){
				return NULL;
			}

			//	気持ちIDに一致する曲データの件数を取得する
			
			$query = $this->find();
			$results = $query->select(['count' => $query->func()->count('*')])
												->where(['feeling_id' => $feelId])
												->toArray();
			//debug($results[0]['count']);

			if($results[0]['count'] <= 0){
				return NULL;
			}

			//	ランダムで選択する（たとえば5件なら、1～5の中から1つ選ぶ）
			$offset = mt_rand(1, $results[0]['count']);
			$offset -= 1;

			$results = $this->find()
											->contain(['Artists', 'Feelings'])
											->select(['Tunes.id', 'Tunes.name', 'Tunes.feeling_id',
																'Artists.name', 'Feelings.name', 'Tunes.comcont'])
											->where(['Tunes.feeling_id' => $feelId])
											->first();

			return $results;
		}

}
