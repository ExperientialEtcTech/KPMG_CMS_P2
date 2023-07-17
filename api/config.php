<?php
$smtpHost = "";//authnz.proofpoint.com
$smtpUser = "a69c1e89-7f07-4295-b99d-e77702010ea1";
$smtpPass = "Dw6=8zYhQHCv";
$smtpFrom = "kaleidoscope@in.kpmg.com";
$smtpPort=587;
$smtpAuth=true;
$smtpSecure='tls';
$smtpFromName = 'KPMG Innovation Kaleidoscope';
$fpMailTo = 'naayeshakatkar@kpmg.com';
			$SMTPOptions=array(
				'ssl'=>array(
					'verify_peer'=>false,
					'verify_peer_name'=>false,
					'allow_self_signed'=>true
				)
			);
?>