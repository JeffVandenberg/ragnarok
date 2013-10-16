<?php
App::uses('AppModel', 'Model');
/**
 * RequestStatus Model
 *
 * @property Request $Request
 */
class RequestStatus extends AppModel
{
    const NewRequest = 1;
    const Submitted = 2;
    const Viewed = 3;
    const Returned = 4;
    const Approved = 5;
    const Rejected = 6;
    const Closed = 7;

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Request' => array(
            'className' => 'Request',
            'foreignKey' => 'request_status_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );
}
