<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP Category
 * @author lahore
 */
class Category extends AppModel {
    public $actsAs = array('Tree');
}
