<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ComplaintsController
 *
 * @author lahore
 */
App::uses('AdminController', 'Controller');
App::uses('CakeTime', 'Utility');
class ConsumerBillsController extends AdminController{
    
    public $uses = array("ConsumerBill");
    public $helpers = array(
	'Form' => array('className' => 'Bs3Helpers.Bs3Form'),
        'Time',
        'AuthAcl.Acl'
    );
    public function update(){
    	$heading = 'Consumer Bills';
        $one_linner = 'Update the consumer_bills table.';

         $this->set(compact('heading','one_linner'));
    }
    public function update_data(){
    	set_time_limit(1000);
    	$this->ConsumerBill->query('TRUNCATE TABLE consumer_bills;');
    	

    	$domestic  = array( );

    	$domastic_file = fopen('BillsDump/domestic.csv', 'r');
    	$c=0;
		while (($line = fgetcsv($domastic_file)) !== FALSE) {
			$c++;
			$line['account'] = $line[0];
			unset($line[0]);
			$line['name'] = $line[1];
			unset($line[1]);
			$line['house'] = $line[2];
			unset($line[2]);
			$line['street'] = $line[3];
			unset($line[3]);
			$line['block'] = $line[4];
			unset($line[4]);
			$line['colony_name'] = $line[5];
			unset($line[5]);
			$line['p_water_rate'] = $line[6];
			unset($line[6]);
			$line['p_sewer_rate'] = $line[7];
			unset($line[7]);
			$line['total'] = $line[8];
			unset($line[8]);
			$line['pay_amount'] = $line[9];
			unset($line[9]);


			$domestic[$c] = $line;
  			
		}
		fclose($domastic_file);
		 $domestic_1000s = array_chunk($domestic, 1000);
		 foreach ($domestic_1000s as  $domestic_1000) {
		 	$this->ConsumerBill->saveAll($domestic_1000);	
		 }

		$commercial  = array( );

    	$commercial_file = fopen('BillsDump/commercial.csv', 'r');
    	$c=0;
		while (($line = fgetcsv($commercial_file)) !== FALSE) {
			$c++;
			$line['account'] = $line[0];
			unset($line[0]);
			$line['name'] = $line[1];
			unset($line[1]);
			$line['house'] = $line[2];
			unset($line[2]);
			$line['street'] = $line[3];
			unset($line[3]);
			$line['block'] = $line[4];
			unset($line[4]);
			$line['colony_name'] = $line[5];
			unset($line[5]);
			$line['p_water_rate'] = $line[6];
			unset($line[6]);
			$line['p_sewer_rate'] = $line[7];
			unset($line[7]);
			$line['total'] = $line[8];
			unset($line[8]);
			$line['pay_amount'] = $line[9];
			unset($line[9]);


			$commercial[$c] = $line;
  			
		}
		fclose($commercial_file);
		 $commercial_1000s = array_chunk($commercial, 1000);
		 foreach ($commercial_1000s as  $commercial_1000) {
		 	$this->ConsumerBill->saveAll($commercial_1000);	
		 }

		 $heading = 'Consumer Bills';
        $one_linner = 'Update the consumer_bills table.';

         $this->set(compact('heading','one_linner'));
		
    	
    	

    }
}