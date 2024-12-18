<?php

/**
 * phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Springy\Utils\BrazilianNumbers\InscricaoEstadual;

final class InscricaoEstadualTest extends TestCase
{
    public function testAcre()
    {
        $this->assertTrue(InscricaoEstadual::isValid('AC', '0108368143106'), 'Valid without mask');
        $this->assertTrue(InscricaoEstadual::isValid('AC', '01.083.681/431-06'), 'Valid with mask');
        $this->assertFalse(InscricaoEstadual::isValid('AC', '0108368143107'), 'Invalid 2nd digit');
        $this->assertFalse(InscricaoEstadual::isValid('AC', '0108368143116'), 'Invalid 1st digit');
        $this->assertFalse(InscricaoEstadual::isValid('AC', '0208368143106'), 'Invalid begin');
        $this->assertFalse(InscricaoEstadual::isValid('AC', '01083681431060'), 'Invalid length');

        $this->assertEquals(InscricaoEstadual::mask('AC', '0108368143106'), '01.083.681/431-06', 'Mask valid');
        $this->assertEquals(InscricaoEstadual::mask('AC', '0108368143107'), '', 'Mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('AC', '01.083.681/431-06'), '0108368143106', 'Unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('AC', '01083681/431-06'), '', 'Unmask invalid');
    }

    public function testAlagoas()
    {
        $this->assertTrue(InscricaoEstadual::isValid('AL', '248659758'), 'Valid');
        $this->assertTrue(InscricaoEstadual::isValid('AL', '247424170'), 'Valid rest 10');
        $this->assertFalse(InscricaoEstadual::isValid('AL', '247424171'), 'Invalid digit');

        $this->assertEquals(InscricaoEstadual::mask('AL', '248713590'), '248713590', 'Mask vaLid');
        $this->assertEquals(InscricaoEstadual::mask('AL', '248713570'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('AL', '248713590'), '248713590', 'Unmask vaLid');
        $this->assertEquals(InscricaoEstadual::unmask('AL', '2487135902'), '', 'Unmask invalid');
    }

    public function testAmapa()
    {
        self::assertTrue(InscricaoEstadual::isValid('AP', "036029572"), 'Valid');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030123459"), 'Valid between 03000001 and 03017000');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030000080"), 'Valid rest 10 between 03000001 and 03017000');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030000160"), 'valid rest 11 between 03000001 and 03017000');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030170011"), 'Valid between 03017001 and 03019022');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030170020"), 'Valid rest 10 between 03017001 and 03019022');
        self::assertTrue(InscricaoEstadual::isValid('AP', "030170071"), 'Valid rest 11 between 03017001 and 03019022');
        self::assertFalse(InscricaoEstadual::isValid('AP', "030170072"), 'Invalid digit');

        $this->assertEquals(InscricaoEstadual::mask('AP', '030170071'), '030170071', 'Mask valid');
        $this->assertEquals(InscricaoEstadual::mask('AP', '0301700712'), '', 'Mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('AP', '030170071'), '030170071', 'Unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('AP', '0301700712'), '', 'Unmask invalid');
    }

    public function testAmazonas()
    {
        $this->assertTrue(InscricaoEstadual::isValid('AM', '784546770'), 'Valid without mask');
        $this->assertTrue(InscricaoEstadual::isValid('AM', '78.454.677-0'), 'Valid with mask');
        $this->assertTrue(InscricaoEstadual::isValid('AM', '000000019'), 'Valid sum less than 11');
        $this->assertTrue(InscricaoEstadual::isValid('AM', '046893830'), 'Valid rest 11');
        $this->assertFalse(InscricaoEstadual::isValid('AM', '784546771'), 'Invalid didit');
        $this->assertFalse(InscricaoEstadual::isValid('AM', '7845467701'), 'Invalid length');

        $this->assertEquals(InscricaoEstadual::mask('AM', '784546770'), '78.454.677-0', 'Mask valid');
        $this->assertEquals(InscricaoEstadual::mask('AM', '7845467701'), '', 'Mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('AM', '784546770'), '784546770', 'Unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('AM', '7845467701'), '', 'Unmask invalid');
    }

    public function testBahia()
    {
        $this->assertTrue(InscricaoEstadual::isValid('BA', '12345663'), 'valid 8 digits rest 10');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '123456-63'), 'valid masked 8 digits rest 10');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '74219145'), 'valid 8 digits rest 11');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '04772253'), 'valid 8 digits begining with 0');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '038343081'), 'valid 9 digits rest 10');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '778514741'), 'valid 9 digits rest 11');
        $this->assertTrue(InscricaoEstadual::isValid('BA', '078771760'), 'valid 9 digits begining with 0');
        $this->assertFalse(InscricaoEstadual::isValid('BA', '12345636'), 'invalid 8 digits rest 10');
        $this->assertFalse(InscricaoEstadual::isValid('BA', '74219154'), 'invalid 8 digits rest 11');
        $this->assertFalse(InscricaoEstadual::isValid('BA', '038343001'), 'invalid 9 digits rest 10');
        $this->assertFalse(InscricaoEstadual::isValid('BA', '778514731'), 'invalid 9 digits rest 11');
        $this->assertFalse(InscricaoEstadual::isValid('BA', '0012345636'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('BA', '19527673'), '195276-73', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('BA', '195276730'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('BA', '195276-73'), '19527673', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('BA', '195276-730'), '', 'unmask invalid');
    }

    public function testCeara()
    {
        $this->assertTrue(InscricaoEstadual::isValid('CE', '17750974-0'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('CE', '177509740'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('CE', '17750974-1'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('CE', '1775097410'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('CE', '177509740'), '17750974-0', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('CE', '1775097401'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('CE', '17750974-0'), '177509740', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('CE', '17750974-01'), '', 'unmask invalid');
    }

    public function testDistritoFederal()
    {
        $this->assertTrue(InscricaoEstadual::isValid('DF', '0754002000176'), 'valid 07 rule');
        $this->assertTrue(InscricaoEstadual::isValid('DF', '0800207300101'), 'valid 08 rule');
        $this->assertTrue(InscricaoEstadual::isValid('DF', '0754002000508'), 'valid rest 10');
        $this->assertFalse(InscricaoEstadual::isValid('DF', '0108368143017'), 'invalid');

        $this->assertEquals(
            InscricaoEstadual::mask('DF', '0703822000139'),
            '07038220001-39',
            'mask valid'
        );
        $this->assertEquals(
            InscricaoEstadual::mask('DF', '07038220001390'),
            '',
            'mask invalid'
        );
        $this->assertEquals(
            InscricaoEstadual::unmask('DF', '07038220001-39'),
            '0703822000139',
            'unmask valid'
        );
        $this->assertEquals(
            InscricaoEstadual::unmask('DF', '07038220001-390'),
            '',
            'unmask invalid'
        );
    }

    public function testEspiritoSanto()
    {
        $this->assertTrue(InscricaoEstadual::isValid('CE', '639191444'), 'valid');
        $this->assertFalse(InscricaoEstadual::isValid('CE', '639191445'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('CE', '0639191444'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('CE', '835079805'), '83507980-5', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('CE', '8350798050'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('CE', '83507980-5'), '835079805', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('CE', '835079805-0'), '', 'unmask invalid');
    }

    public function testGoias()
    {
        $this->assertTrue(InscricaoEstadual::isValid('GO', '109161793'), 'valid');
        $this->assertTrue(InscricaoEstadual::isValid('GO', '101030940'), 'valid rest 10');
        $this->assertFalse(InscricaoEstadual::isValid('GO', '109161794'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('GO', '121031131'), 'invalid begin');
        $this->assertFalse(InscricaoEstadual::isValid('GO', '0101030940'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('GO', '100322026'), '10.032.202-6', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('GO', '1003220260'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('GO', '10.032.202-6'), '100322026', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('GO', '10032202-6'), '', 'unmask invalid');
    }

    public function testMaranhao()
    {
        $this->assertTrue(InscricaoEstadual::isValid('MA', '12648629-8'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('MA', '126486298'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('MA', '12648629-0'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('MA', '11648629-8'), 'invalid begin');
        $this->assertFalse(InscricaoEstadual::isValid('MA', '1264862980'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('MA', '126486298'), '12648629-8', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('MA', '1264862980'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('MA', '12648629-8'), '126486298', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('MA', '126486298-0'), '', 'unmask invalid');
    }

    public function testMatoGrosso()
    {
        $this->assertTrue(InscricaoEstadual::isValid('MT', '03667403692'), 'valid');
        $this->assertFalse(InscricaoEstadual::isValid('MT', '03667403693'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('MT', '003667403692'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('MT', '03667403692'), '0366740369-2', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('MT', '036674036920'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('MT', '0366740369-2'), '03667403692', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('MT', '03667403692-0'), '', 'unmask invalid');
    }

    public function testMatoGrossoDoSul()
    {
        $this->assertTrue(InscricaoEstadual::isValid('MS', '287972666'), 'valid without mask');
        $this->assertTrue(InscricaoEstadual::isValid('MS', '28797266-6'), 'valid with mask');
        $this->assertTrue(InscricaoEstadual::isValid('MS', '28000009-0'), 'valid rest 10');
        $this->assertTrue(InscricaoEstadual::isValid('MS', '28000003-0'), 'valid rest 11');
        $this->assertFalse(InscricaoEstadual::isValid('MS', '28797266-0'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('MS', '2879726660'), 'invalid length');
        $this->assertFalse(InscricaoEstadual::isValid('MS', '17750974-0'), 'invalid begin');

        $this->assertEquals(InscricaoEstadual::mask('MS', '287972666'), '28797266-6', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('MS', '2879726660'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('MS', '28797266-6'), '287972666', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('MS', '287972666-0'), '', 'unmask invalid');
    }

    public function testMinasGerais()
    {
        $this->assertTrue(InscricaoEstadual::isValid('MG', '4466174458972'), 'valid without mask');
        $this->assertTrue(InscricaoEstadual::isValid('MG', '446.617.445/8972'), 'valid with mask');
        $this->assertTrue(InscricaoEstadual::isValid('MG', '4333908330410'), 'valid rest 10');
        $this->assertTrue(InscricaoEstadual::isValid('MG', '4333908332560'), 'valid rest 11');
        $this->assertFalse(InscricaoEstadual::isValid('MG', '4466174458970'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('MG', '446617445/8972'), 'invalid mask');

        $this->assertEquals(InscricaoEstadual::mask('MG', '4466174458972'), '446.617.445/8972', 'mask valid');
        $this->assertEquals(InscricaoEstadual::unmask('MG', '446.617.445/8972'), '4466174458972', 'unmask valid');
    }

    public function testPara()
    {
        $this->assertTrue(InscricaoEstadual::isValid('PA', '158309782'), 'valid without mask');
        $this->assertTrue(InscricaoEstadual::isValid('PA', '15830978-2'), 'valid with single mask');
        $this->assertTrue(InscricaoEstadual::isValid('PA', '15-830978-2'), 'valid with complete mask');
        $this->assertFalse(InscricaoEstadual::isValid('PA', '15-8309782'), 'invalid mask');
        $this->assertFalse(InscricaoEstadual::isValid('PA', '15-830978-0'), 'invalid digit');

        $this->assertEquals(InscricaoEstadual::mask('PA', '158309782'), '15-830978-2', 'mask valid');
        $this->assertEquals(InscricaoEstadual::unmask('PA', '15-830978-2'), '158309782', 'unmask valid');
    }

    public function testParaiba()
    {
        $this->assertTrue(InscricaoEstadual::isValid('PB', '33484972-1'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('PB', '334849721'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('PB', '33484972-0'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('PB', '3348497210'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('PB', '334849721'), '33484972-1', 'mask valid');
        $this->assertEquals(InscricaoEstadual::unmask('PB', '33484972-1'), '334849721', 'unmask valid');
    }

    public function testParana()
    {
        $this->assertTrue(InscricaoEstadual::isValid('PR', '970.00508-04'), 'valid full mask');
        $this->assertTrue(InscricaoEstadual::isValid('PR', '97000508-04'), 'valid single mask');
        $this->assertTrue(InscricaoEstadual::isValid('PR', '9700050804'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('PR', '970.00508-14'), 'invalid 1st digit');
        $this->assertFalse(InscricaoEstadual::isValid('PR', '970.00508-01'), 'invalid 2nd digit');
        $this->assertFalse(InscricaoEstadual::isValid('PR', '970.0050804'), 'invalid mask');

        $this->assertEquals(InscricaoEstadual::mask('PR', '9700050804'), '970.00508-04', 'mask valid');
        $this->assertEquals(InscricaoEstadual::unmask('PR', '970.00508-04'), '9700050804', 'unmask valid');
    }

    public function testPernambuco()
    {
        $this->assertTrue(InscricaoEstadual::isValid('PE', '9165506-48'), 'valid with mask');
        $this->assertTrue(InscricaoEstadual::isValid('PE', '916550648'), 'valid without mask');
        $this->assertFalse(InscricaoEstadual::isValid('PE', '9165506-08'), 'invalid 1st digit');
        $this->assertFalse(InscricaoEstadual::isValid('PE', '9165506-40'), 'invalid 2nd digit');
        $this->assertFalse(InscricaoEstadual::isValid('PE', '09165506-48'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('PE', '916550648'), '9165506-48', 'mask valid');
        $this->assertEquals(InscricaoEstadual::unmask('PE', '9165506-48'), '916550648', 'unmask valid');
    }

    public function testPiaui()
    {
        $this->assertTrue(InscricaoEstadual::isValid('PI', '78145189-2'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('PI', '781451892'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('PI', '78145189-0'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('PI', '078145189-2'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('PI', '781451892'), '78145189-2', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('PI', '7814518920'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('PI', '78145189-2'), '781451892', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('PI', '78145189-20'), '', 'unmask invalid');
    }

    public function testRioDeJaneiro()
    {
        $this->assertTrue(InscricaoEstadual::isValid('RJ', '18.251.03-5'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('RJ', '18251035'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RJ', '18.251.03-0'), 'invalid digit');
        $this->assertFalse(InscricaoEstadual::isValid('RJ', '182510350'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('RJ', '18251035'), '18.251.03-5', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('RJ', '182510350'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('RJ', '18.251.03-5'), '18251035', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('RJ', '1825103-5'), '', 'unmask invalid');
    }

    public function testRioGrandeDoNorte()
    {
        $this->assertTrue(InscricaoEstadual::isValid('RN', '20.040.040-1'), 'valid 9 digits masked');
        $this->assertTrue(InscricaoEstadual::isValid('RN', '200400401'), 'valid 9 digits unmasked');
        $this->assertTrue(InscricaoEstadual::isValid('RN', '20.0.040.040-0'), 'valid 10 digits masked');
        $this->assertTrue(InscricaoEstadual::isValid('RN', '20.0.040.040-0'), 'valid 10 digits unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RN', '20.040.040-0'), 'invalid 9 digits');
        $this->assertFalse(InscricaoEstadual::isValid('RN', '20.0.040.040-1'), 'invalid 10 digits');
        $this->assertFalse(InscricaoEstadual::isValid('RN', '20004004001'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('RN', '200400401'), '20.040.040-1', 'mask 9 digits');
        $this->assertEquals(InscricaoEstadual::mask('RN', '2000400400'), '20.0.040.040-0', 'mask 9 digits');
        $this->assertEquals(InscricaoEstadual::mask('RN', '20004004001'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('RN', '20.040.040-1'), '200400401', 'unmask 9 digits');
        $this->assertEquals(InscricaoEstadual::unmask('RN', '20.0.040.040-0'), '2000400400', 'unmask 10 digits');
        $this->assertEquals(InscricaoEstadual::unmask('RN', '200.040.040-0'), '', 'unmask invalid');
    }

    public function testRioGrandeDoSul()
    {
        $this->assertTrue(InscricaoEstadual::isValid('RS', '557/8013232'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('RS', '5578013232'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RS', '557/8013230'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('RS', '5578013230'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RS', '55780132320'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('RS', '5578013232'), '557/8013232', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('RS', '55780132320'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('RS', '557/8013232'), '5578013232', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('RS', '557/80132320'), '', 'unmask invalid');
    }

    public function testRondonia()
    {
        $this->assertTrue(InscricaoEstadual::isValid('RO', '0000000062521-3'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('RO', '00000000625213'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RO', '0000000062521-0'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('RO', '00000000625210'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RO', '62521-3'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('RO', '00000000625213'), '0000000062521-3', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('RO', '625213'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('RO', '0000000062521-3'), '00000000625213', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('RO', '62521-3'), '', 'unmask invalid');
    }

    public function testRoraima()
    {
        $this->assertTrue(InscricaoEstadual::isValid('RR', '24006628-1'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('RR', '240066281'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RR', '23006628-1'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('RR', '240066280'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('RR', '0240066281'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('RR', '240066281'), '24006628-1', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('RR', '0240066281'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('RR', '24006628-1'), '240066281', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('RR', '024006628-1'), '', 'unmask invalid');
    }

    public function testSantaCatarina()
    {
        $this->assertTrue(InscricaoEstadual::isValid('SC', '917.832.442'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('SC', '917832442'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SC', '917.832.440'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('SC', '917832440'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SC', '0917832442'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('SC', '917832442'), '917.832.442', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('SC', '0917832442'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('SC', '917.832.442'), '917832442', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('SC', '917832.442'), '', 'unmask invalid');
    }

    public function testSaoPauloIndCom()
    {
        $this->assertTrue(InscricaoEstadual::isValid('SP', '110.042.490.114'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('SP', '110042490114'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', '110.042.491.114'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', '110042490110'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', '0110042490114'), 'invalid length');

        $this->assertEquals(InscricaoEstadual::mask('SP', '110042490114'), '110.042.490.114', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('SP', '0110042490114'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('SP', '110.042.490.114'), '110042490114', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('SP', '110042490.114'), '', 'unmask invalid');
    }

    public function testSaoPauloRural()
    {
        $this->assertTrue(InscricaoEstadual::isValid('SP', 'P-01100424.3/002'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('SP', 'P011004243002'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', 'P-01100424.0/002'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', 'P011004240002'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SP', 'P01100424.3/002'), 'invalid format');

        $this->assertEquals(InscricaoEstadual::mask('SP', 'P011004243002'), 'P-01100424.3/002', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('SP', 'P0110042430020'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('SP', 'P-01100424.3/002'), 'P011004243002', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('SP', 'P01100424.3/002'), '', 'unmask invalid');
    }

    public function testSergipe()
    {
        $this->assertTrue(InscricaoEstadual::isValid('SE', '55399849-8'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('SE', '553998498'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SE', '55399849-0'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('SE', '553998490'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('SE', '055399849-8'), 'invalid format');

        $this->assertEquals(InscricaoEstadual::mask('SE', '553998498'), '55399849-8', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('SE', '0553998498'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('SE', '55399849-8'), '553998498', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('SE', '055399849-8'), '', 'unmask invalid');
    }

    public function testTocantins()
    {
        $this->assertTrue(InscricaoEstadual::isValid('TO', '52914885-4'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('TO', '5203914885-4'), 'valid masked');
        $this->assertTrue(InscricaoEstadual::isValid('TO', '529148854'), 'valid unmasked');
        $this->assertTrue(InscricaoEstadual::isValid('TO', '52039148854'), 'valid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('TO', '5200914885-4'), 'invalid masked');
        $this->assertFalse(InscricaoEstadual::isValid('TO', '52009148854'), 'invalid unmasked');
        $this->assertFalse(InscricaoEstadual::isValid('TO', '05203914885-4'), 'invalid format');

        $this->assertEquals(InscricaoEstadual::mask('TO', '529148854'), '52914885-4', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('TO', '52039148854'), '5203914885-4', 'mask valid');
        $this->assertEquals(InscricaoEstadual::mask('TO', '052039148854'), '', 'mask invalid');
        $this->assertEquals(InscricaoEstadual::unmask('TO', '52914885-4'), '529148854', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('TO', '5203914885-4'), '52039148854', 'unmask valid');
        $this->assertEquals(InscricaoEstadual::unmask('TO', '05203914885-4'), '', 'unmask invalid');
    }
}
