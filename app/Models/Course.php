<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected  $fillable = [
        'name',
    ];
   
    //đây là 1 cái mảng mình khai báo cho thằng model để nó truyền những thứ mình muốn vào 
    //ở đây sẽ có 2 cách để làm 1 là thêm cái protected $fillable để chắc chắn là chỉ cho phép điển những cột nào mình muốn 
    //Cách thứ 2 nó là mình sẽ ghi ra những cột nào không cho điền đó là guarded
    // protected $guarded = [
    //     'created_at',
    //     'updated_at',
    // ];
    public function getYearCreatedAtAttribute()
    {
        return date_format(date_create($this->created_at),'Y');
    }
}
