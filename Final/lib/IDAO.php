<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author mhall and nwityak
 */
namespace finalproject;
interface IDAO {
    
    //function get by ID
   public function getByID($id);
   //delete function
   public function delete($id);
   // save function
   public function save(IModel $model);
   //get all rows
   public function getAllRows();
}