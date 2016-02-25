<?php
namespace App\Model\Entity;
 
use Cake\ORM\Entity;
 
/**
 *  * Message Entity.
 *   *
 *    * @property int $id
 *     * @property int $members_id
 *      * @property \App\Model\Entity\Member $member
 *       * @property string $title
 *        * @property string $comment
 *         */
class Message extends Entity
{
	protected $_accessible = [
							'*' => true,
							'id' => false,
						];
}
