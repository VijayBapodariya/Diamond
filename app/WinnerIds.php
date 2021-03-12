<?php
namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class WinnerIds extends Model
{
    protected $collection = 'winnerIds';
    protected $primaryKey = '_id';
}	
?>
