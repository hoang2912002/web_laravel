<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StudentStatusEnum extends Enum
{   
    //THỨ 1;Khai báo nó là const public để hiểu là có thể dùng ở areawhere
    //Thứ 2: Đặt tên cho nó 
    public const  DI_HOC = 1;
    public const  VANG = 2;
    public const  BAO_LUU = 3;

    public static function getArrayValue()
    {
        return [
            'Đi học' => self::DI_HOC,
            'Vắng' => self::VANG,
            'Bảo lưu' =>self::BAO_LUU,
        ];
        #self bản chất là gọi đến chính nó như $this
        # Dùng self khi nó là public static thì phải dùng self
    }

    public static function getKeyByValue($value):string
    {
        return array_search($value,self::getArrayValue(),true);//true ở đây  nghĩa là '==='


        //Ở đây tức là mình sẽ truyền biến $value = "1,2,3" sau đó sẽ dùng hàm array_search 
        //để tìm kiếm trong class getArrayValue 
        //VD: $vallue = 1
        //Thì attribute của nó sẽ là DI_HOC 
        //ở hàm getKeyByValue sẽ lấy cái $value = 1 đó search ở trong getArrayValue r in ra Đi học        
    }
}
