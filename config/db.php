<?php

class Database {
    private static $serverName = "192.168.1.36";
    private static $database = "Consultas_AX";
    private static $username = "fox";
    private static $password = "Tr@v3rS";
    private static $connection;

    public static function conectar() {
        if (!isset(self::$connection)) {
            $connectionOptions = array(
                "Database" => self::$database,
                "Uid" => self::$username,
                "PWD" => self::$password
            );

            self::$connection = sqlsrv_connect(self::$serverName, $connectionOptions);

            if (!self::$connection) {
                die(print_r(sqlsrv_errors(), true));
            }
        }

        return self::$connection;
    }

    public static function cerrarConexion() {
        if (isset(self::$connection)) {
            sqlsrv_close(self::$connection);
            self::$connection = null;
        }
    }
}
/*

QUERY CUENTAS BANCARIAS


SELECT  DISTINCT
	--TOP 10 
	S1.dataareaid AS DATAAREAID,
	S1.BankAccount  AS VENDORBANKACCOUNTID,
	s2.name AS BANKNAME,
	s2.BankGroupID AS BANKGROUPID,
	S1.ACCOUNTNUM AS VENDORACCOUNTNUMBER,
	'' AS ROUTINGNUMBERTYPE,
	CASE 
		WHEN s1.VendGroup = 'EXTRANJERO' THEN    S2.RegistrationNum----PREGUNAR SI SOLO EXTRAJERO ASIA ACREDORES
		WHEN s1.VendGroup = 'ASIA' THEN    S2.RegistrationNum
		WHEN s1.VendGroup = 'NACIONAL' THEN ''
		ELSE ''
		END AS ROUTINGNUMBER,
	S2.ACCOUNTNUM AS BANKACCOUNTNUMBER,
	S2.ForeignSWIFT_RU AS SWIFTCODE,
	S2.BankIBAN AS IBAN,
	'' AS EXPIRATIONDATE,
	'' AS RECIPIENTTEXTCODE,
	S1.Currency AS CURRENTCURRENCYCODE,
	S3.LocationName AS ADDRESSDESCRIPTION,
	S1.TRV_ProvPrevio AS ADDRESSCOUNTRY,-----PREGUNTAR ORIGEN DE DATO 
	S3.ZIPCODE AS ADDRESSZIPCODE,
	S3.ADDRESS AS ADDRESSSTREET,
	S3.STREETNUMBER AS ADDRESSSTREETNUMBER,
	S5.LOCATOR AS CONTACTPHONENUMBER,
	s5.LOCATOREXTENSION AS CONTACTPHONENUMBEREXTENSION,
	s8.NAME AS CONTACTNAME,
	----------CAQMPOS EXTRAS SOLICITADOS POR DAVID CORTES
	S2.VendPaymentTextCode,
	S2.MsgToBank
	-----------------------------------------------------
	--S3.*
	FROM VENDTABLE S1
	LEFT JOIN VENDBANKACCOUNT S2 
		ON S1.BankAccount = S2.ACCOUNTID
		AND S1.ACCOUNTNUM = S2.VENDACCOUNT
		AND S2.DATAAREAID = 'trv'
	 JOIN DirPartyPostalAddressView S3 
		ON S3.PARTY = S1.PARTY
		AND S3.XRECVERSION_LOGISTICSPOSTALADDRESS = 1
		AND S3.ISPRIMARY = 1	
	LEFT JOIN DIRPARTYLOCATION S4
		ON S4.PARTY=S1.PARTY	
	JOIN LogisticsElectronicAddress S5
		ON S5.LOCATION = S4.LOCATION
			AND TYPE = 1
			AND S5.LOCATOR LIKE '%[0-9][0-9][0-9]%' 
			AND S5.LOCATION IS NOT NULL 	
	LEFT JOIN CONTACTPERSON S6
		ON S6.CONTACTPERSONID=S1.CONTACTPERSONID
		AND S6.DATAAREAID = 'trv'
	LEFT JOIN CONTACTPERSON S7 
		ON S7.CONTACTPERSONID = s1.CONTACTPERSONID
		AND S7.DATAAREAID = 'trv'
	LEFT JOIN DIRPARTYNAMEVIEW S8
		ON S8.PARTY = S7.PARTY
	--WHERE S1.ACCOUNTNUM = 'PR0652'--'P0503'--'P0260'--'P0616'--'P0883'
	WHERE S1.ACCOUNTNUM LIKE 'P%' OR S1.ACCOUNTNUM LIKE 'A%' OR S1.ACCOUNTNUM LIKE 'D%'
	AND   S1.dataareaid = 'trv';


*/
?>




