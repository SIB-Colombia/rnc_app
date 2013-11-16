<?php
class BatchController extends Controller
{
	public $layout='//layouts/column2';
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','include', 'pasouno', 'pasodos', 'pasotres'),
				'users'=>array('lgrajales'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionPasouno() {
		Yii::app()->db->createCommand('update catalogoespecies set contacto_id = 238 WHERE catalogoespecies_id IN (3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068)')->query();
	}
	
	public function actionPasodos() {
		$arreglo = array(3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068);
		foreach ($arreglo as $value) {
			$atributo = new Atributovalor();
			$atributo->atributotipo_id=4;
			$atributo->valor='Ficha elaborada con el apoyo de Carbones del Cerrejón Limited.';
			$atributo->save();
			$ceatributovalor = new CeAtributovalor();
			$ceatributovalor->etiqueta=436;
			$ceatributovalor->catalogoespecies_id=$value;
			$ceatributovalor->valor=$atributo->id;
			$ceatributovalor->save();
		}
	}
	
	public function actionPasotres() {
		$arreglo = array(3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068);
		foreach ($arreglo as $value) {
			$atributo = new Atributovalor();
			$atributo->atributotipo_id=2;
			$atributo->valor='223';
			$atributo->save();
			$ceatributovalor = new CeAtributovalor();
			$ceatributovalor->etiqueta=19;
			$ceatributovalor->catalogoespecies_id=$value;
			$ceatributovalor->valor=$atributo->id;
			$ceatributovalor->save();
		}
	}
	
	public function actionPasocuatro() {
		$listAtributoValor= Yii::app()->db->createCommand('SELECT atributovalor."id" FROM catalogoespecies INNER JOIN ce_atributovalor ON catalogoespecies.catalogoespecies_id = ce_atributovalor.catalogoespecies_id INNER JOIN atributovalor ON ce_atributovalor.valor = atributovalor."id" WHERE ce_atributovalor.etiqueta = 28 AND atributovalor.valor = \'2552\' AND catalogoespecies.catalogoespecies_id IN (3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068)')->queryAll();
		$rs=array();
		foreach($listAtributoValor as $item){
			//process each item here
			$rs[]=$item['id'];
		
		}
		$idsAtributoValor = join(',',$rs);
		$listCeAtributoValor= Yii::app()->db->createCommand('SELECT ce_atributovalor.ceatributovalor_id FROM catalogoespecies INNER JOIN ce_atributovalor ON catalogoespecies.catalogoespecies_id = ce_atributovalor.catalogoespecies_id INNER JOIN atributovalor ON ce_atributovalor.valor = atributovalor."id" WHERE ce_atributovalor.etiqueta = 28 AND atributovalor.valor = \'2552\' AND catalogoespecies.catalogoespecies_id IN (3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068)')->queryAll();
		$rs2=array();
		foreach($listCeAtributoValor as $item){
			//process each item here
			$rs2[]=$item['ceatributovalor_id'];
		
		}
		$idsCeAtributoValor = join(',',$rs2);
		Yii::app()->db->createCommand('delete from ce_atributovalor where ce_atributovalor.ceatributovalor_id IN ('.$idsCeAtributoValor.')')->query();
		Yii::app()->db->createCommand('delete from atributovalor where atributovalor."id" IN ('.$idsAtributoValor.')')->query();
	}
	
	public function actionPasocinco() {
		$arreglo = array(3879, 3880, 3882, 3883, 3884, 3990, 3886, 3887, 3888, 3889, 3890, 3891, 3892, 3893, 3894, 3895, 3896, 3897, 3898, 3899, 3900, 3901, 3916, 3918, 3919, 3920, 3921, 3922, 3924, 3925, 3926, 3928, 3929, 3930, 3932, 3934, 3935, 3937, 3938, 3939, 3941, 3942, 3943, 3944, 3957, 3958, 3959, 3960, 3961, 3962, 3963, 3964, 3965, 3966, 3967, 3968, 3969, 3970, 3971, 3972, 3973, 3996, 3974, 3975, 3976, 3977, 3978, 3979, 3980, 3981, 3982, 3983, 3984, 3985, 3997, 3986, 3987, 3988, 3989, 3998, 3999, 4001, 4002, 4003, 4004, 4005, 4006, 4007, 4008, 4009, 4010, 4011, 4012, 4013, 4014, 4015, 4016, 4017, 4018, 4019, 4020, 4021, 4022, 4023, 4024, 4025, 4026, 4027, 4028, 4029, 4030, 4031, 4032, 4033, 4034, 4035, 4036, 4037, 4038, 4039, 4040, 4041, 4042, 4043, 4044, 4045, 4046, 4047, 4048, 4049, 4050, 4051, 4052, 4053, 4054, 4055, 4056, 4057, 4058, 4059, 4060, 4061, 4062, 4063, 4064, 4065, 4066, 4067, 4068);
		foreach ($arreglo as $value) {
			$atributo = new Atributovalor();
			$atributo->atributotipo_id=3;
			$atributo->valor='3046';
			$atributo->save();
			$ceatributovalor = new CeAtributovalor();
			$ceatributovalor->etiqueta=28;
			$ceatributovalor->catalogoespecies_id=$value;
			$ceatributovalor->valor=$atributo->id;
			$ceatributovalor->save();
		}
		foreach ($arreglo as $value) {
			$atributo = new Atributovalor();
			$atributo->atributotipo_id=3;
			$atributo->valor='3062';
			$atributo->save();
			$ceatributovalor = new CeAtributovalor();
			$ceatributovalor->etiqueta=28;
			$ceatributovalor->catalogoespecies_id=$value;
			$ceatributovalor->valor=$atributo->id;
			$ceatributovalor->save();
		}
	}

	function showError(Exception $e)
	{
		if($e->getCode()==23000)
			$message = "This operation is not permitted due to an existing foreign key reference.";
		else
			$message = "Invalid operation.";
		throw new CHttpException($e->getCode(), $message);
	}
}