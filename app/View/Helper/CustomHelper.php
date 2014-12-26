<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomHelper
 *
 * @author lahore
 */

class CustomHelper extends AppHelper{
    
    public function formatTree($data){
        CakeLog::info($data['data']['Category']['id']);
        return $data['data']['Category']['name'];
    }
}
