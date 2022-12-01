<?php

// $a = [1,2,3,4,5];

// // echo "1" + 3;
// // echo $a[count($a)-1];
// // $a = "abduselam";


// foreach($a as $index => $value){
//     echo $value;
// }
// // print_r(str_split($a));
// // echo $a*2;

// namespace A\B;

// class T{
//     static function my(){
//         echo __METHOD__;
//     }
// }

// print T::my();

// function a(&$ta)
// {
//     foreach ($ta as &$va) {
//         $va = $va + 1;
//     }
//     $va = $va + 2;
//     // echo $va;
// }

// $ta = array(1, 2, 3);

// a($ta);

// print_r($ta);


// function t($x){
//     return function($y) use($x){
//         return str_repeat($y,$x);
//     };
// }

// $a = t(2);
// $b = t(3);

// echo $a(3).$b(2);

// echo isset($c) ? $a.$b.$c : ($c = 't').'r';

// class turing{
//     public $x = 1;

//     public function __construct(){
//         ++$this->x;
//     }

//     function __invoke()
//     {
//             return ++$this->x;
//     }
// }

// $tu  = new turing();

// echo $tu();


// $turing = function (){};
// echo gettype($turing);

// echo "1" *2  *"007";
// array_w

// echo '3' . (print '5') +7;


// function a(){

//     $a = [1,2,3,4,5];

//     $returnValue = [];

//     $returnValue[] = [];
//     $len = count($a);
    
//     foreach ($a as $key => $value) {
//         $returnValue[] = [$value];
//         for ($i=0; $i <= $key-1 ; $i++) { 
//             $returnValue[] = [$a[$i],$value];  
//         }
//     }
//     $returnValue[] = $a;



//     return $returnValue;
// }

// echo json_encode(a());


// $a = [];

// $a[5] = 43;
// if( isset($a[5])){
//     echo var_dump($a);
// }else{
//     echo "not present";
// }

$res = -1;

$nums = [];

$cards =  [[5,7,3,9,4,9,8,3,1], [1,2,2,4,4,1], [1,2,3]];

foreach ($cards as $card){
    foreach ($card as $cardNumber) {
        if(isset($nums[$cardNumber])){
            $nums[$cardNumber] = $nums[$cardNumber]+1;
        }else{
            $nums[$cardNumber] = 1;

        }
    }
}

print_r($nums);