<?php
namespace backend\modules\credit_rating\models\advanced;

use common\modules\credit_rating\models\advanced\equifax\CreditRatingAdvancedEquifax;
use common\modules\credit_rating\models\advanced\nbki\CreditRatingAdvancedNbki;
use Yii;

class CreditRatingAdvancedRequest extends \common\modules\credit_rating\models\CreditRatingAdvancedRequest
{
    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
            self::STATUS_NEW => Yii::t('app', 'Status New'),
            self::STATUS_CREATED_REQUEST_FILE => Yii::t('app', 'Status Created Request Files'),
            self::STATUS_CREATED_SIGN_FILE => Yii::t('app', 'Status Created Sign Files'),
            self::STATUS_GOT_SIGN_RESPONSE => Yii::t('app', 'Status Got Sign Response'),
            self::STATUS_FILE_DECRYPTED => Yii::t('app', 'Status File Decrypted'),
            self::STATUS_PARSER_ERROR => Yii::t('app', 'Status Parser Error'),
            self::STATUS_COMPLETED => Yii::t('app', 'Status Completed'),
        ];
    }

    /**
     * @return array
     */
    public function modelsTranslate()
    {
        return [
            'CreditRatingAdvancedEquifax' => Yii::t('app', 'Equifax'),
            'CreditRatingAdvancedNbki' => Yii::t('app', 'Nbki'),
        ];
    }

    /**
     * @return array
     */
    public function getTabs( $advancedModel )
    {
        switch( $advancedModel::className() ){
            case CreditRatingAdvancedNbki::className():
                return [
                    'creditRatingAdvancedNbkiIdReplies' => [
                        'label' => Yii::t('app', 'Identification'),
                    ],
                    'creditRatingAdvancedNbkiPersonReplies' => [
                        'label' => Yii::t('app', 'Name (Person)'),
                    ],
                    'creditRatingAdvancedNbkiBusinessReplies' => [
                        'label' => Yii::t('app', 'Business')
                    ],
                    'creditRatingAdvancedNbkiAddressReplies' => [
                        'label' => Yii::t('app', 'Address')
                    ],
                    'creditRatingAdvancedNbkiPhoneReplies' => [
                        'label' => Yii::t('app', 'Phone'),
                    ],
                    'creditRatingAdvancedNbkiEmploymentReplies' => [
                        'label' => Yii::t('app', 'Employment'),
                    ],
                    'creditRatingAdvancedNbkiAccountReplies' => [
                        'label' => Yii::t('app', 'Trade (Account)'),
                        'relations' => [
                            'creditRatingAdvancedNbkiAccountReplyBankGuarantees' => [
                                'label' => Yii::t('app', 'Bank Guarantee')
                            ],
                            'creditRatingAdvancedNbkiAccountReplyCollaterals' => [
                                'label' => Yii::t('app', 'Collateral')
                            ],
                            'creditRatingAdvancedNbkiAccountReplyGuarantors' => [
                                'label' => Yii::t('app', 'Guarantor')
                            ],
                        ]
                    ],
                    'creditRatingAdvancedNbkiLegalItemsReplies' => [
                        'label' => Yii::t('app', 'Legal Items'),
                    ],
                    'creditRatingAdvancedNbkiConsumerBankruptcyReplies' => [
                        'label' => Yii::t('app', 'Consumer Bankruptcy'),
                    ],
                    'creditRatingAdvancedNbkiBankruptcyReplies' => [
                        'label' => Yii::t('app', 'Bankruptcy')
                    ],
                    'creditRatingAdvancedNbkiOfficialInfoReplies' => [
                        'label' => Yii::t('app', 'Official Information'),
                    ],
                    'creditRatingAdvancedNbkiInformationPartReplies' => [
                        'label' => Yii::t('app', 'Information Part'),
                    ],
                    'creditRatingAdvancedNbkiInquiryReplies' => [
                        'label' => Yii::t('app', 'Inquiries'),
                    ],
                    'creditRatingAdvancedNbkiOwnInquiriesInquiries' => [
                        'label' => Yii::t('app', 'Own Inquiries Information'),
                    ],
                    'creditRatingAdvancedNbkiOwnAccounts' => [
                        'label' => Yii::t('app', 'Own Accounts Information'),
                    ],
                    'creditRatingAdvancedNbkiCalcs' => [
                        'label' => Yii::t('app', 'Calcs'),
                        'relations' => [
                            'creditRatingAdvancedNbkiCalcTotalCurrentBalances' => [
                                'label' => Yii::t('app', 'Total Current Balances')
                            ],
                            'creditRatingAdvancedNbkiCalcTotalHighCredits' => [
                                'label' => Yii::t('app', 'Total High Credits')
                            ],
                            'creditRatingAdvancedNbkiCalcTotalOutstandingBalances' => [
                                'label' => Yii::t('app', 'Outstanding Balances')
                            ],
                            'creditRatingAdvancedNbkiCalcTotalPastDueBalances' => [
                                'label' => Yii::t('app', 'Past Due Balances')
                            ],
                            'creditRatingAdvancedNbkiCalcTotalScheduledPaymnts' => [
                                'label' => Yii::t('app', 'Scheduled Paymnts')
                            ],
                        ]
                    ],
                ];
                break;
            case CreditRatingAdvancedEquifax::className():
                return [
                    'creditRatingAdvancedEquifaxPrivates' => [
                        'label' => Yii::t('app', 'Privates'),
                        'relations' => [
                            'docs' => [
                                'label' => Yii::t('app', 'Privates Docs')
                            ],
                        ]
                    ],
                    'creditRatingAdvancedEquifaxPbouls' => [
                        'label' => Yii::t('app', 'Pbouls'),
                    ],
                    'creditRatingAdvancedEquifaxAddresses' => [
                        'label' => Yii::t('app', 'Addresses'),
                    ],
                    'creditRatingAdvancedEquifaxPhones' => [
                        'label' => Yii::t('app', 'Phones'),
                    ],
                    'creditRatingAdvancedEquifaxIncapacities' => [
                        'label' => Yii::t('app', 'Incapacities'),
                    ],
                    'creditRatingAdvancedEquifaxCredits' => [
                        'label' => Yii::t('app', 'Credits'),
                        'relations' => [
                            'creditRatingAdvancedEquifaxCreditInfo' => [
                                'label' => Yii::t('app', 'CreditInfo')
                            ],
                        ]
                    ],
                    'creditRatingAdvancedEquifaxCollaterals' => [
                        'label' => Yii::t('app', 'Collaterals'),
                    ],
                    'creditRatingAdvancedEquifaxCredGuarantees' => [
                        'label' => Yii::t('app', 'CredGuarantees'),
                    ],
                    'creditRatingAdvancedEquifaxGuarantees' => [
                        'label' => Yii::t('app', 'Guarantees'),
                        'relations' => [
                            'creditRatingAdvancedEquifaxGuaranteeCredInfos' => [
                                'label' => Yii::t('app', 'GuaranteeCredInfos')
                            ],
                        ]
                    ],
                    'creditRatingAdvancedEquifaxBankGuarants' => [
                        'label' => Yii::t('app', 'BankGuarants'),
                    ],
                    'creditRatingAdvancedEquifaxCollections' => [
                        'label' => Yii::t('app', 'Collections'),
                    ],
                    'creditRatingAdvancedEquifaxCourts' => [
                        'label' => Yii::t('app', 'Courts'),
                    ],
                    'creditRatingAdvancedEquifaxBankruptcies' => [
                        'label' => Yii::t('app', 'Bankruptcies'),
                    ],
                    'creditRatingAdvancedEquifaxInterests' => [
                        'label' => Yii::t('app', 'Interests'),
                    ],
                    'creditRatingAdvancedEquifaxOwnInterests' => [
                        'label' => Yii::t('app', 'OwnInterests'),
                    ],
                    'creditRatingAdvancedEquifaxInfoRequests' => [
                        'label' => Yii::t('app', 'InfoRequests'),
                    ],
                    'creditRatingAdvancedEquifaxScorings' => [
                        'label' => Yii::t('app', 'Scorings'),
                    ],
                    'creditRatingAdvancedEquifaxInformationParts' => [
                        'label' => Yii::t('app', 'InformationParts'),
                        'relations' => [
                            'creditRatingAdvancedEquifaxInformationPartApplications' => [
                                'label' => Yii::t('app', 'InformationPartApplications')
                            ],
                            'creditRatingAdvancedEquifaxInformationPartCredits' => [
                                'label' => Yii::t('app', 'InformationPartCredits')
                            ],
                            'creditRatingAdvancedEquifaxInformationPartFailures' => [
                                'label' => Yii::t('app', 'InformationPartFailures')
                            ],
                        ]
                    ],
                ];
                break;
            default:
                return [];
                break;
        }
    }

}