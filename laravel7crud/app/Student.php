<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use Sortable;

    use SoftDeletes;

    protected $table = "students";

    protected $fillable = [
        'full_name', 'image', 'phone_no', 'address', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $sortable = [
        'id', 'full_name', 'image','phone_no', 'address', 'created_at', 'updated_at'
    ];

    public static function getStudent()
    {
        $records = DB::table('students')->select("id","full_name","image","phone_no","address")->orderBy('id','asc')->get()->toArray();
        return $records;
    }
}
