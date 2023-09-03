<?php

namespace App\Repositories;

interface IBaseRepository
{
    function getAllData();
    function getDataById($id);
    function create($entity);
    function update($id, $entity);
    function delete($id);
}
