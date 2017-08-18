<?php
use backend\modules\app_interface\models\Notifications;
use rmrevin\yii\fontawesome\FA;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= Yii::$app->params['frontURL'] .\backend\modules\user\models\Profile::getUserAvatar(Yii::$app->user->id) ?>" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= \backend\modules\user\models\Profile::getUserFullName(Yii::$app->user->id, false); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => Yii::t('app', 'Users'),
                        'icon' => FA::_USERS,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Questionnaires'), 'icon' => FA::_USER_PLUS, 'url' => ['/user/registrations/index/']],
                            [
                                'label' => Yii::t('app', 'Registrations'),
                                'icon' => FA::_USER,
                                'url' => ['/user/registered/index/'],
//                                'items' => [
//                                    ['label' => Yii::t('app', 'Registered'), 'icon' => 'fa fa-user', 'url' => ['/user/registered/index/']],
//                                    ['label' => Yii::t('app', 'Bonus'), 'icon' => 'fa fa-circle-o', 'url' => ['/user/bonus/index/']]
//                                ]
                            ],
                            [
                                'label' => Yii::t('app', 'Recovery'),
                                'icon' => FA::_RECYCLE,
                                'url' => ['/user/recovery/index/'],
                            ],
                            ['label' => Yii::t('app', 'Deleted users'), 'icon' => FA::_ARCHIVE, 'url' => ['/user/archive/index']],
                            ['label' => Yii::t('app', 'User actions'), 'icon' => FA::_BATTERY_FULL, 'url' => ['/user/user-activities/index']],
                            [
                                'label' => Yii::t('app', 'Credit Histories'),
                                'icon' => FA::_HISTORY,
                                'url' => ['/user/credit-history/index'],
                            ],
                            [
                                'label' => Yii::t('app', 'Sharing'),
                                'icon' => FA::_SHARE,
                                'url' => '#',
                                'items' => [
                                    ['label' => Yii::t('app', 'All shares'), 'icon' => FA::_SHARE_ALT, 'url' => ['/social/social-share/index']],
                                    ['label' => Yii::t('app', 'Invites'), 'icon' => FA::_AMERICAN_SIGN_LANGUAGE_INTERPRETING, 'url' => ['/user/user-invitation-email/index'],],
                                ],
                            ],
                            ['label' => Yii::t('app', 'Identifications'), 'icon' => FA::_HISTORY, 'url' => ['/identification/default/index']],
                            [
                                'label' => Yii::t('app', 'Transactions'),
                                'icon' => FA::_HOURGLASS,
                                'url' => ['/user/transactions/index/'],
                            ],
                            [
                                'label' => Yii::t('app', 'Confirm Data logs'),
                                'icon' => FA::_INDUSTRY,
                                'url' => ['/user-log/confirm-data/index'],
                            ],
                            [
                                'label' => Yii::t('app', 'Sms logs'),
                                'icon' => FA::_INDUSTRY,
                                'url' =>['/api/sms-log/index']
                            ],
                            [
                                'label' => Yii::t('app', 'Settings'),
                                'icon' => FA::_COGS,
                                'url' => '#',
                                'items' => [
                                    ['label' => Yii::t('app', 'Bonus'), 'icon' => FA::_MONEY, 'url' => ['/user/bonus/index/']],
                                    ['label' => Yii::t('app', 'Sharing settings'), 'icon' => FA::_COG, 'url' => ['/social/social-share-templates/index']],
                                    [
                                        'label' => Yii::t('app', 'Secret Question'),
                                        'icon' => FA::_GROUP,
                                        'url' =>['/user/user-secret-question-list/index/']
                                    ],
                                    ['label' => Yii::t('app', 'Identification Methods'), 'icon' => FA::_LIST_ALT, 'url' => ['/identification/identification-method/index']],
                                    ['label' => Yii::t('app', 'Offices'), 'icon' => FA::_BUILDING_O, 'url' => ['/identification/identification-office/index']],
                                ]
                            ],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Products'),
                        'icon' => FA::_COGS,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'All products'), 'icon' => FA::_MONEY, 'url' => ['/shop/default/index/']],
//                            ['label' => Yii::t('app', 'Sharing settings'), 'icon' => FA::_COG, 'url' => ['/social/social-share-templates/index']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Credit Rating'),
                        'icon' => FA::_LINE_CHART,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Priority settings'), 'icon' => FA::_YELP, 'url' => ['/credit_rating/priorities/index']],
                            ['label' => Yii::t('app', 'Credit Rating Models Timeouts'), 'icon' => FA::_CLOCK_O, 'url' => ['/credit_rating/credit-rating-models-timeout/index']],
                            ['label' => Yii::t('app', 'Credit Rating Line Settings'), 'icon' => FA::_UNDERLINE, 'url' => ['/credit_rating/credit-rating-line-settings/index']],
                            ['label' => Yii::t('app', 'Additional reports'), 'icon' => FA::_YELP, 'url' => ['/credit_rating/advanced/credit-rating-advanced-request/index']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Credit Products'),
                        'icon' => FA::_CC_MASTERCARD,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Credit Products'), 'icon' => FA::_GIFT, 'url' => ['/credit_product/credit-product/index']],
                            ['label' => Yii::t('app', 'Credit Product Categories'), 'icon' => FA::_BARS, 'url' => ['/credit_product/credit-product-category/index']],
                            ['label' => Yii::t('app', 'Credit Product Category Groups'), 'icon' => FA::_DELICIOUS, 'url' => ['/credit_product/credit-product-category-group/index']],
                            ['label' => Yii::t('app', 'Credit Product Types'), 'icon' => FA::_CUBES, 'url' => ['/credit_product/credit-product-type/index']],
                            ['label' => Yii::t('app', 'Credit Product Fields'), 'icon' => FA::_STACK_EXCHANGE, 'url' => ['/credit_product/credit-product-field/index']],
                            ['label' => Yii::t('app', 'Credit Product References'), 'icon' => FA::_BOOK, 'url' => ['/credit_product/credit-product-reference/index']],
                            ['label' => Yii::t('app', 'Credit Product Widgets'), 'icon' => FA::_LIST_ALT, 'url' => ['/credit_product/credit-product-widget/index']],

                            /*
                            ['label' => Yii::t('app', 'Credit Product References'), 'icon' => FA::_BOOK, 'url' => '#', 'items' => [

                                ['label' => Yii::t('app', 'Credit Product Reference Values'), 'icon' => 'fa fa-file-word-o', 'url' => ['/credit_product/credit-product-reference-values/index']],
                            ]],
                            */

                            ['label' => Yii::t('app', 'Credit Product Reviews'), 'icon' => FA::_COMMENT_O, 'url' => '#', 'items' => [
                                ['label' => Yii::t('app', 'Credit Product Reviews'), 'icon' => FA::_COMMENT_O, 'url' => ['/credit_product/credit-product-review/index']],
                                ['label' => Yii::t('app', 'Credit Product Review Comments'), 'icon' => FA::_COMMENT_O, 'url' => ['/credit_product/credit-product-review-comment/index']],
                            ]],



                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Community'),
                        'icon' => FA::_USERS,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Questions'), 'icon' => FA::_QUESTION_CIRCLE, 'url' => ['/community/questions/index']],
                            ['label' => Yii::t('app', 'Commentaries'), 'icon' => FA::_WEIXIN, 'url' => ['/community/q-comments/index']],
                            ['label' => Yii::t('app', 'Categories'), 'icon' => FA::_TAGS, 'url' => ['/community/questions-categories/index']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'News'),
                        'icon' => FA::_FONT,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'What\'s New'), 'icon' => FA::_FONT, 'url' => ['/news/default/index']],
                            ['label' => Yii::t('app', 'News Category'), 'icon' => FA::_ARROWS, 'url' => ['/news/news-category/index']],
                            ['label' => Yii::t('app', 'News Types'), 'icon' => FA::_ARROWS_ALT, 'url' => ['/news/news-type/index']],
                            ['label' => Yii::t('app', 'Commentaries'), 'icon' => FA::_WEIXIN, 'url' => ['/news/default/comments']],
                        ]
                    ],
                    [
                        'label' => Yii::t('app', 'Pages'),
                        'icon' => FA::_NEWSPAPER_O,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'All pages'), 'icon' => FA::_OBJECT_GROUP, 'url' => ['/landing/landing/index']],
                                ['label' => Yii::t('app', 'Sliders'), 'icon' => FA::_FILE_IMAGE_O, 'url' => ['#'],
                                    'items' => [
                                        ['label' => Yii::t('app', 'All Sliders'), 'icon' => FA::_OBJECT_GROUP, 'url' => ['/widgets/sliders/index']],
                                        ['label' => Yii::t('app', 'Slider Items'), 'icon' => FA::_PICTURE_O, 'url' => ['/widgets/slider-items/index']],
                                    ]
                                ],
                                ['label' => Yii::t('app', 'Reviews'), 'icon' => FA::_WEIXIN, 'url' => ['/widgets/reviews/index']],
                            ]
                    ],
                    [
                        'label' => Yii::t('app', 'General settings'),
                        'icon' => FA::_COGS,
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('app', 'Translations'), 'icon' => FA::_FONT, 'url' => ['/app_interface/default/index/ ']],
                            ['label' => Yii::t('app', 'Phone Operators'), 'icon' => FA::_PHONE, 'url' => ['/services/phone-operator/index']],
                            ['label' => Yii::t('app', 'Post Services'), 'icon' => FA::_ENVELOPE, 'url' => ['/services/post-service/index']],
                            ['label' => Yii::t('app', 'Notifications') . (!is_null(Notifications::getUnreadNotifications()) ? ' (' . Notifications::getUnreadNotifications() . ')' : ''),
                                'icon' => FA::_BELL,
                                'url' => ['/app_interface/notifications/index/']
                            ],
                            ['label' => Yii::t('app', 'Cities and Regions'), 'icon' => FA::_GLOBE, 'url' => ['#'], 'items' => [
                                ['label' => Yii::t('app', 'Regions'), 'icon' => FA::_ARROWS, 'url' => ['/location/region/index']],
                                ['label' => Yii::t('app', 'Cities'), 'icon' => FA::_ARROWS_ALT, 'url' => ['/location/city/index']],
                            ]],
                            ['label' => Yii::t('app', 'Stop Words'), 'icon' => FA::_SHIELD, 'url' => ['/app_interface/stop-words/index/']],
                            ['label' => Yii::t('app', 'Partners'), 'icon' => FA::_USER_PLUS, 'url' => ['/partners/partners/index']],
                            ['label' => Yii::t('app', 'API'), 'icon' => FA::_CUBES, 'url' => ['/partners/partners/api']],
                            ['label' => Yii::t('app', 'Page Fields'), 'icon' => FA::_SHIELD, 'url' => ['/field/default/index/']],
                            ['label' => Yii::t('app', 'SEO'), 'icon' => FA::_GOOGLE_PLUS, 'url' => ['/app_interface/seo/index/']],
                            ['label' => Yii::t('app', 'Site Settings'), 'icon' => FA::_CUBES, 'url' => ['/app_interface/site-settings/index/']],
                            ['label' => Yii::t('app', 'Reference Books'), 'icon' => FA::_BOOK, 'url' => ['/common/reference-book/index']],
                            ['label' => Yii::t('app', 'Event Actions'), 'icon' => FA::_ARROWS, 'url' => ['/event/event/index']],
                            ['label' => Yii::t('app', 'Email Templates'), 'icon' => FA::_CROP, 'url' => ['/common/email-templates/index']],
                            ['label' => Yii::t('app', 'Export'), 'icon' => FA::_EXTERNAL_LINK, 'url' => ['/export/export-queue/index']],
                        ]
                    ],
//                    [
//                        'label' => 'Same tools',
//                        'icon' => 'fa fa-share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'fa fa-circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'fa fa-circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
