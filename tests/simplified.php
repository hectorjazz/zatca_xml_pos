<?php
include('../vendor/autoload.php');

// Address country
$country = (new \BaseetApp\UBL\Country())
    ->setIdentificationCode('SA');

// Full address
$address1 = (new \BaseetApp\UBL\Address())
    ->setStreetName('الامير سلطان')
    ->setBuildingNumber(3242)
    ->setPlotIdentification(4323)
    ->setCitySubdivisionName('32423423')
    ->setCityName('الرياض | Riyadh')
    ->setPostalZone('32432')
    ->setCountry($country);

$legalEt1 = (new \BaseetApp\UBL\LegalEntity())
    ->setRegistrationName('Acme Widget’s LTD');
// Supplier company node
$supplierCompany = (new \BaseetApp\UBL\Party())
    ->setPartyIdentification(
        (new \BaseetApp\UBL\PartyIdentification())
            ->setId("324223432432432")
            ->setSchemeID("CRN")
    )
    // ->setName('Supplier Company Name')
    // ->setPhysicalLocation($address)
    ->setPartyTaxScheme(
        (new \BaseetApp\UBL\PartyTaxScheme)
            ->setCompanyId(311111111101113)
            ->setTaxScheme((new \BaseetApp\UBL\TaxScheme)->setId('VAT'))
    )
    ->setPostalAddress($address1)
    ->setLegalEntity($legalEt1);

// Client contact node
$clientContact = (new \BaseetApp\UBL\Contact())
    // ->setName('Client name')
    ->setElectronicMail('email@client.com')
    ->setTelephone('0032 472 123 456')
    ->setTelefax('0032 9 1234 567');

$legalEt2 = (new \BaseetApp\UBL\LegalEntity())
    ->setRegistrationName('');

$address2 = (new \BaseetApp\UBL\Address())
    ->setStreetName('')
    // ->setBuildingNumber(1111)
    // ->setPlotIdentification(2223)
    ->setCitySubdivisionName('32423423')
    // ->setCityName('الرياض | Dammam')
    // ->setPostalZone('12222')
    ->setCountry($country);

// Client company node
$clientCompany = (new \BaseetApp\UBL\Party())
    // ->setPartyIdentification(
    //     (new \BaseetApp\UBL\PartyIdentification())
    //         ->setId("311111112111113")
    //         ->setSchemeID("NAT")
    // )
    // ->setName('My client')
    ->setPostalAddress($address2)
    ->setPartyTaxScheme(
        (new \BaseetApp\UBL\PartyTaxScheme)
            // ->setCompanyId(311111112101113)
            ->setTaxScheme((new \BaseetApp\UBL\TaxScheme)->setId('VAT'))
    )
    // ->setContact($clientContact);
    ->setLegalEntity($legalEt2);

$legalMonetaryTotal = (new \BaseetApp\UBL\LegalMonetaryTotal())
    ->setLineExtensionAmount(201.00)
    ->setTaxExclusiveAmount(201.00)
    ->setTaxInclusiveAmount(231.15)
    ->setAllowanceTotalAmount(0)
    ->setPrepaidAmount(0)
    ->setPayableAmount(231.15);

// Tax scheme
$taxScheme = (new \BaseetApp\UBL\TaxScheme())
    ->setId(
        "VAT",
        // array(
        //     'schemeID' => "UN/ECE 5305",
        //     'schemeAgencyID' => "6"
        // )
    );
$taxScheme_01 = (new \BaseetApp\UBL\TaxScheme())
    ->setId(
        "VAT",
        // array(
        //     'schemeID' => "UN/ECE 5305",
        //     'schemeAgencyID' => "6"
        // )
    );

$classifiedTax_01 = (new \BaseetApp\UBL\ClassifiedTaxCategory())
    ->setId("S")
    ->setPercent(15)
    ->setTaxScheme($taxScheme_01);
// Product
$productItem_01 = (new \BaseetApp\UBL\Item())
    ->setName('كتاب')
    // ->setDescription('Product Description')
    // ->setSellersItemIdentification('SELLERID')
    ->setClassifiedTaxCategory($classifiedTax_01);


$invoiceLineAllowanceCharges_01 = array(
    (new \BaseetApp\UBL\AllowanceCharge)
        ->setChargeIndicator(false)
        ->setAllowanceChargeReason("discount")
        ->setAmount(0)
);

// Price
$price_01 = (new \BaseetApp\UBL\Price())
    // ->setBaseQuantity(1)
    // ->setUnitCode(\BaseetApp\UBL\UnitCode::UNIT)
    ->setAllowanceCharges($invoiceLineAllowanceCharges_01)
    ->setPriceAmount(3);

// Invoice Line tax totals
$lineTaxTotal_01 = (new \BaseetApp\UBL\TaxTotal())
    ->setTaxAmount(14.85)
    ->setRoundingAmount(113.85);

// InvoicePeriod
$invoicePeriod = (new \BaseetApp\UBL\InvoicePeriod())
    ->setStartDate(new \DateTime());

// Invoice Line(s)
$invoiceLines = [];

$invoiceLines[] = (new \BaseetApp\UBL\InvoiceLine())
    ->setId(1)
    ->setUnitCode("PCE")
    ->setLineExtensionAmount(99)
    ->setItem($productItem_01)
    // ->setInvoicePeriod($invoicePeriod)
    ->setPrice($price_01)
    // ->setAccountingCostCode('Product 123')
    ->setTaxTotal($lineTaxTotal_01)
    ->setInvoicedQuantity(33);

// Tax scheme
$taxScheme_02 = (new \BaseetApp\UBL\TaxScheme())
    ->setId(
        "VAT",
        // array(
        //     'schemeID' => "UN/ECE 5305",
        //     'schemeAgencyID' => "6"
        // )
    );

$classifiedTax_02 = (new \BaseetApp\UBL\ClassifiedTaxCategory())
    ->setId("S")
    ->setPercent(15)
    ->setTaxScheme($taxScheme_02);
// Product
$productItem_02 = (new \BaseetApp\UBL\Item())
    ->setName('قلم')
    // ->setDescription('Product Description')
    // ->setSellersItemIdentification('SELLERID')
    ->setClassifiedTaxCategory($classifiedTax_02);

$invoiceLineAllowanceCharges_02 = array(
    (new \BaseetApp\UBL\AllowanceCharge)
        ->setChargeIndicator(false)
        ->setAllowanceChargeReason("discount")
        ->setAmount(0)
);

// Price
$price_02 = (new \BaseetApp\UBL\Price())
    // ->setBaseQuantity(1)
    // ->setUnitCode(\BaseetApp\UBL\UnitCode::UNIT)
    ->setAllowanceCharges($invoiceLineAllowanceCharges_02)
    ->setPriceAmount(34);

// Invoice Line tax totals
$lineTaxTotal_02 = (new \BaseetApp\UBL\TaxTotal())
    ->setTaxAmount(15.30)
    ->setRoundingAmount(117.30);

$invoiceLines[] = (new \BaseetApp\UBL\InvoiceLine())
    ->setId(2)
    ->setUnitCode("PCE")
    ->setLineExtensionAmount(102)
    ->setItem($productItem_02)
    // ->setInvoicePeriod($invoicePeriod)
    ->setPrice($price_02)
    // ->setAccountingCostCode('Product 123')
    ->setTaxTotal($lineTaxTotal_02)
    ->setInvoicedQuantity(3);

// Total Taxes
$taxCategory = (new \BaseetApp\UBL\TaxCategory())
    ->setPercent(15)
    ->setTaxScheme($taxScheme);

$taxSubTotal = (new \BaseetApp\UBL\TaxSubTotal())
    ->setTaxableAmount(201.00)
    ->setTaxAmount(30.15)
    ->setTaxCategory($taxCategory);


$taxTotal = (new \BaseetApp\UBL\TaxTotal())
    ->addTaxSubTotal($taxSubTotal)
    ->setTaxAmount(30.15);


$sign = (new \BaseetApp\UBL\SignatureInformation)
    ->setReferencedSignatureID("urn:oasis:names:specification:ubl:signature:Invoice")
    ->setID('urn:oasis:names:specification:ubl:signature:1');


$ublDecoment = (new \BaseetApp\UBL\UBLDocumentSignatures)
    ->setSignatureInformation($sign);

$extensionContent = (new \BaseetApp\UBL\ExtensionContent)
    ->setUBLDocumentSignatures($ublDecoment);

$UBLExtension[] = (new \BaseetApp\UBL\UBLExtension)
    ->setExtensionURI('urn:oasis:names:specification:ubl:dsig:enveloped:xades')
    ->setExtensionContent($extensionContent);

$UBLExtensions = (new \BaseetApp\UBL\UBLExtensions)
    ->setUBLExtensions($UBLExtension);

$additionalDocumentReference1 = (new \BaseetApp\UBL\AdditionalDocumentReference)
    ->setId('ICV')
    ->setUUID('10');

// $additionalDocumentReference2 = (new \BaseetApp\UBL\AdditionalDocumentReference)
//     ->setId('PIH')
//     ->setAttachment(
//         (new \BaseetApp\UBL\Attachment)
//             ->setFileContent("NWZlY2ViNjZmZmM4NmYzOGQ5NTI3ODZjNmQ2OTZjNzljMmRiYzIzOWRkNGU5MWI0NjcyOWQ3M2EyN2ZiNTdlOQ==")
//     );

// $additionalDocumentReference3 = (new \BaseetApp\UBL\AdditionalDocumentReference)
//     ->setId('QR')
//     ->setAttachment(
//         (new \BaseetApp\UBL\Attachment)
//             ->setFileContent("ARNBY21lIFdpZGdldOKAmXMgTFREAg8zMTExMTExMTExMDExMTMDFDIwMjItMDktMDdUMTI6MjE6MjhaBAQ0LjYwBQMwLjYGLFdJNkdOd3R5NFhyVGMzUDFXclJNMXhsaHF6OVRpbVhkQ0xIOXNnbWowU2c9B2BNRVVDSVFDQ0dMN0FKYWNWT2JzN2x1RllUYnNxS3I5cUxaWCtMWWpaaXZPakRObmFZZ0lnVDBTclpaS2szTDhmelY4L0o3aDlwN3dIMEJvcXBsVzBSQmNXT1ZOZVcwdz0IWDBWMBAGByqGSM49AgEGBSuBBAAKA0IABGGDDKDmhWAITDv7LXqLX2cmr6+qddUkpcLCvWs5rC2O29W/hS4ajAK4Qdnahym6MaijX75Cg3j4aao7ouYXJ9E=")
//     );

$invoiceAllowanceCharges = array(
    (new \BaseetApp\UBL\AllowanceCharge)
        ->setChargeIndicator(false)
        ->setAllowanceChargeReason("discount")
        ->setAmount(0)
        ->setTaxCategory(
            (new \BaseetApp\UBL\TaxCategory)
                ->setId(
                    "S",
                    array(
                        'schemeID' => "UN/ECE 5305",
                        'schemeAgencyID' => "6"
                    )
                )
                ->setPercent(15)
                ->setTaxScheme(
                    (new \BaseetApp\UBL\TaxScheme)
                        ->setId("VAT", 
                            array(
                                'schemeID' => "UN/ECE 5305",
                                'schemeAgencyID' => "6"
                            )
                        )
                )
        )
);

// Invoice object
$invoice = (new \BaseetApp\UBL\Invoice())
    ->setUBLExtensions($UBLExtensions)
    ->setUUID('8e6000cf-1a98-4174-b3e7-b5d5954bc10d')
    ->setId("SME00010")
    ->setInvoiceTypeCode(\BaseetApp\UBL\InvoiceTypeCode::INVOICE)
    ->setInvoiceSubType(\BaseetApp\UBL\InvoiceSubType::SIMPLIFIED_TAX)
    ->setNote("ABC")
    ->setIssueDate(new \DateTime())
    ->setIssueTime((new \DateTime()))
    ->addAdditionalDocumentReference($additionalDocumentReference1)
    // ->addAdditionalDocumentReference($additionalDocumentReference2)
    // ->addAdditionalDocumentReference($additionalDocumentReference3)
    ->Signature(new \BaseetApp\UBL\Signature)
    ->setAccountingSupplierParty($supplierCompany)
    ->setAccountingCustomerParty($clientCompany)
    // ->setDelivery((new \BaseetApp\UBL\Delivery)->setActualDeliveryDate(new \DateTime()))
    ->setPaymentMeans((new \BaseetApp\UBL\PaymentMeans)->setPaymentMeansCode(10))
    ->setAllowanceCharges(
        $invoiceAllowanceCharges
    )
    // ->setSupplierAssignedAccountID('10001')
    ->setInvoiceLines($invoiceLines)
    ->setLegalMonetaryTotal($legalMonetaryTotal)
    ->setTaxTotal($taxTotal);

$generator = new \BaseetApp\UBL\Generator();
$outputXMLString = $generator->invoice($invoice);

// echo $outputXMLString;
// Create PHP Native DomDocument object, that can be
// used to validate the generate XML
$dom = new \DOMDocument;

// $dom->loadXML(mb_convert_encoding($outputXMLString, 'HTML-ENTITIES', 'UTF-8'));
$dom->loadXML($outputXMLString);
$dom->save('simplified_num.xml');
