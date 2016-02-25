<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
 
/**
 *  * Member Entity.
 *   *
 *    * @property int $id
 *     * @property string $name
 *      * @property string $mail
 *       * @property \App\Model\Entity\Message[] $messages
 *        */
class Member extends Entity
{
	protected $_accessible = [
							'*' => true,
							'id' => false,
						];
}
