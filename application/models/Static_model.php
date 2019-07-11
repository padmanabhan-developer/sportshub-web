<?php
class Static_model extends CI_Model
{
	public function GetSportsList()
	{
		$sports = array(
							array(
									'id'=>'6',
									'name' => 'G.A.A.',
									'image' => ''
									),
							array(
									'id'=>'7',
									'name' => 'Rugby Union',
									'image' => 'irbrugby.jpg'
									),
							array(
									'id'=>'9',
									'name' => 'Motor Sport',
									'image' => ''
									),
							array(
									'id'=>'10',
									'name' => 'American Football',
									'image' => 'asonfl.gif'
									),
							array(
									'id'=>'11',
									'name' => 'Baseball',
									'image' => ''
									),
							array(
									'id'=>'12',
									'name' => 'Rugby League',
									'image' => ''
									),
							array(
									'id'=>'13',
									'name' => 'American Hockey',
									'image' => ''
									),
							array(
									'id'=>'20',
									'name' => 'Volleyball',
									'image' => ''
									),
							array(
									'id'=>'16',
									'name' => 'Ice Hockey',
									'image' => ''
									),
							array(
									'id'=>'17',
									'name' => 'Basketball - American',
									'image' => ''
									),
							array(
									'id'=>'18',
									'name' => 'Basketball - FIBA/ULEB',
									'image' => ''
									),
							array(
									'id'=>'19',
									'name' => 'Golf',
									'image' => ''
									),
							array(
									'id'=>'21',
									'name' => 'Euro Handball',
									'image' => ''
									),
							array(
									'id'=>'22',
									'name' => 'Boxing / Fighting',
									'image' => ''
									),
							array(
									'id'=>'23',
									'name' => 'Bandy',
									'image' => ''
									),
							array(
									'id'=>'24',
									'name' => 'Basketball - NBA Europe',
									'image' => ''
									),
							array(
									'id'=>'25',
									'name' => 'fakeBOXING',
									'image' => ''
									),
							array(
									'id'=>'26',
									'name' => 'Australian Rules',
									'image' => ''
									),
							array(
									'id'=>'27',
									'name' => 'Beach Soccer',
									'image' => ''
									),
							array(
									'id'=>'28',
									'name' => 'Kickboxing',
									'image' => ''
									),
							array(
									'id'=>'1',
									'name' => 'Football',
									'image' => ''
									)
 							);
		
		return $sports;
	}
}

?>