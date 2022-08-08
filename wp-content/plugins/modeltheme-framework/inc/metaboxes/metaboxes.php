<?php
add_filter( 'cmb_meta_boxes', 'modeltheme_metaboxes' );
function modeltheme_metaboxes( array $meta_boxes ) {

    // Start with an underscore to hide fields from custom fields list
    $prefix = 'smartowl_';


    $fa_list = array(
      'fa fa-angellist' => 'fa fa-angellist',
      'fa fa-area-chart' => 'fa fa-area-chart',
      'fa fa-at' => 'fa fa-at',
      'fa fa-bell-slash' => 'fa fa-bell-slash',
      'fa fa-bell-slash-o' => 'fa fa-bell-slash-o',
      'fa fa-bicycle' => 'fa fa-bicycle',
      'fa fa-binoculars' => 'fa fa-binoculars',
      'fa fa-birthday-cake' => 'fa fa-birthday-cake',
      'fa fa-bus' => 'fa fa-bus',
      'fa fa-calculator' => 'fa fa-calculator',
      'fa fa-cc' => 'fa fa-cc',
      'fa fa-cc-amex' => 'fa fa-cc-amex',
      'fa fa-cc-discover' => 'fa fa-cc-discover',
      'fa fa-cc-mastercard' => 'fa fa-cc-mastercard',
      'fa fa-cc-paypal' => 'fa fa-cc-paypal',
      'fa fa-cc-stripe' => 'fa fa-cc-stripe',
      'fa fa-cc-visa' => 'fa fa-cc-visa',
      'fa fa-copyright' => 'fa fa-copyright',
      'fa fa-eyedropper' => 'fa fa-eyedropper',
      'fa fa-futbol-o' => 'fa fa-futbol-o',
      'fa fa-google-wallet' => 'fa fa-google-wallet',
      'fa fa-ils' => 'fa fa-ils',
      'fa fa-ioxhost' => 'fa fa-ioxhost',
      'fa fa-lastfm' => 'fa fa-lastfm',
      'fa fa-lastfm-square' => 'fa fa-lastfm-square',
      'fa fa-line-chart' => 'fa fa-line-chart',
      'fa fa-meanpath' => 'fa fa-meanpath',
      'fa fa-newspaper-o' => 'fa fa-newspaper-o',
      'fa fa-paint-brush' => 'fa fa-paint-brush',
      'fa fa-paypal' => 'fa fa-paypal',
      'fa fa-pie-chart' => 'fa fa-pie-chart',
      'fa fa-plug' => 'fa fa-plug',
      'fa fa-shekel' => 'fa fa-shekel',
      'fa fa-sheqel' => 'fa fa-sheqel',
      'fa fa-slideshare' => 'fa fa-slideshare',
      'fa fa-soccer-ball-o' => 'fa fa-soccer-ball-o',
      'fa fa-toggle-off' => 'fa fa-toggle-off',
      'fa fa-toggle-on' => 'fa fa-toggle-on',
      'fa fa-trash' => 'fa fa-trash',
      'fa fa-tty' => 'fa fa-tty',
      'fa fa-twitch' => 'fa fa-twitch',
      'fa fa-wifi' => 'fa fa-wifi',
      'fa fa-yelp' => 'fa fa-yelp',
      'fa fa-adjust' => 'fa fa-adjust',
      'fa fa-anchor' => 'fa fa-anchor',
      'fa fa-archive' => 'fa fa-archive',
      'fa fa-arrows' => 'fa fa-arrows',
      'fa fa-arrows-h' => 'fa fa-arrows-h',
      'fa fa-arrows-v' => 'fa fa-arrows-v',
      'fa fa-asterisk' => 'fa fa-asterisk',
      'fa fa-automobile' => 'fa fa-automobile',
      'fa fa-ban' => 'fa fa-ban',
      'fa fa-bank' => 'fa fa-bank',
      'fa fa-bar-chart' => 'fa fa-bar-chart',
      'fa fa-bar-chart-o' => 'fa fa-bar-chart-o',
      'fa fa-barcode' => 'fa fa-barcode',
      'fa fa-bars' => 'fa fa-bars',
      'fa fa-beer' => 'fa fa-beer',
      'fa fa-bell' => 'fa fa-bell',
      'fa fa-bell-o' => 'fa fa-bell-o',
      'fa fa-bolt' => 'fa fa-bolt',
      'fa fa-bomb' => 'fa fa-bomb',
      'fa fa-book' => 'fa fa-book',
      'fa fa-bookmark' => 'fa fa-bookmark',
      'fa fa-bookmark-o' => 'fa fa-bookmark-o',
      'fa fa-briefcase' => 'fa fa-briefcase',
      'fa fa-bug' => 'fa fa-bug',
      'fa fa-building' => 'fa fa-building',
      'fa fa-building-o' => 'fa fa-building-o',
      'fa fa-bullhorn' => 'fa fa-bullhorn',
      'fa fa-bullseye' => 'fa fa-bullseye',
      'fa fa-cab' => 'fa fa-cab',
      'fa fa-calendar' => 'fa fa-calendar',
      'fa fa-calendar-o' => 'fa fa-calendar-o',
      'fa fa-camera' => 'fa fa-camera',
      'fa fa-camera-retro' => 'fa fa-camera-retro',
      'fa fa-car' => 'fa fa-car',
      'fa fa-caret-square-o-down' => 'fa fa-caret-square-o-down',
      'fa fa-caret-square-o-left' => 'fa fa-caret-square-o-left',
      'fa fa-caret-square-o-right' => 'fa fa-caret-square-o-right',
      'fa fa-caret-square-o-up' => 'fa fa-caret-square-o-up',
      'fa fa-certificate' => 'fa fa-certificate',
      'fa fa-check' => 'fa fa-check',
      'fa fa-check-circle' => 'fa fa-check-circle',
      'fa fa-check-circle-o' => 'fa fa-check-circle-o',
      'fa fa-check-square' => 'fa fa-check-square',
      'fa fa-check-square-o' => 'fa fa-check-square-o',
      'fa fa-child' => 'fa fa-child',
      'fa fa-circle' => 'fa fa-circle',
      'fa fa-circle-o' => 'fa fa-circle-o',
      'fa fa-circle-o-notch' => 'fa fa-circle-o-notch',
      'fa fa-circle-thin' => 'fa fa-circle-thin',
      'fa fa-clock-o' => 'fa fa-clock-o',
      'fa fa-close' => 'fa fa-close',
      'fa fa-cloud' => 'fa fa-cloud',
      'fa fa-cloud-download' => 'fa fa-cloud-download',
      'fa fa-cloud-upload' => 'fa fa-cloud-upload',
      'fa fa-code' => 'fa fa-code',
      'fa fa-code-fork' => 'fa fa-code-fork',
      'fa fa-coffee' => 'fa fa-coffee',
      'fa fa-cog' => 'fa fa-cog',
      'fa fa-cogs' => 'fa fa-cogs',
      'fa fa-comment' => 'fa fa-comment',
      'fa fa-comment-o' => 'fa fa-comment-o',
      'fa fa-comments' => 'fa fa-comments',
      'fa fa-comments-o' => 'fa fa-comments-o',
      'fa fa-compass' => 'fa fa-compass',
      'fa fa-credit-card' => 'fa fa-credit-card',
      'fa fa-crop' => 'fa fa-crop',
      'fa fa-crosshairs' => 'fa fa-crosshairs',
      'fa fa-cube' => 'fa fa-cube',
      'fa fa-cubes' => 'fa fa-cubes',
      'fa fa-cutlery' => 'fa fa-cutlery',
      'fa fa-dashboard' => 'fa fa-dashboard',
      'fa fa-database' => 'fa fa-database',
      'fa fa-desktop' => 'fa fa-desktop',
      'fa fa-dot-circle-o' => 'fa fa-dot-circle-o',
      'fa fa-download' => 'fa fa-download',
      'fa fa-edit' => 'fa fa-edit',
      'fa fa-ellipsis-h' => 'fa fa-ellipsis-h',
      'fa fa-ellipsis-v' => 'fa fa-ellipsis-v',
      'fa fa-envelope' => 'fa fa-envelope',
      'fa fa-envelope-o' => 'fa fa-envelope-o',
      'fa fa-envelope-square' => 'fa fa-envelope-square',
      'fa fa-eraser' => 'fa fa-eraser',
      'fa fa-exchange' => 'fa fa-exchange',
      'fa fa-exclamation' => 'fa fa-exclamation',
      'fa fa-exclamation-circle' => 'fa fa-exclamation-circle',
      'fa fa-exclamation-triangle' => 'fa fa-exclamation-triangle',
      'fa fa-external-link' => 'fa fa-external-link',
      'fa fa-external-link-square' => 'fa fa-external-link-square',
      'fa fa-eye' => 'fa fa-eye',
      'fa fa-eye-slash' => 'fa fa-eye-slash',
      'fa fa-fax' => 'fa fa-fax',
      'fa fa-female' => 'fa fa-female',
      'fa fa-fighter-jet' => 'fa fa-fighter-jet',
      'fa fa-file-archive-o' => 'fa fa-file-archive-o',
      'fa fa-file-audio-o' => 'fa fa-file-audio-o',
      'fa fa-file-code-o' => 'fa fa-file-code-o',
      'fa fa-file-excel-o' => 'fa fa-file-excel-o',
      'fa fa-file-image-o' => 'fa fa-file-image-o',
      'fa fa-file-movie-o' => 'fa fa-file-movie-o',
      'fa fa-file-pdf-o' => 'fa fa-file-pdf-o',
      'fa fa-file-photo-o' => 'fa fa-file-photo-o',
      'fa fa-file-picture-o' => 'fa fa-file-picture-o',
      'fa fa-file-powerpoint-o' => 'fa fa-file-powerpoint-o',
      'fa fa-file-sound-o' => 'fa fa-file-sound-o',
      'fa fa-file-video-o' => 'fa fa-file-video-o',
      'fa fa-file-word-o' => 'fa fa-file-word-o',
      'fa fa-file-zip-o' => 'fa fa-file-zip-o',
      'fa fa-film' => 'fa fa-film',
      'fa fa-filter' => 'fa fa-filter',
      'fa fa-fire' => 'fa fa-fire',
      'fa fa-fire-extinguisher' => 'fa fa-fire-extinguisher',
      'fa fa-flag' => 'fa fa-flag',
      'fa fa-flag-checkered' => 'fa fa-flag-checkered',
      'fa fa-flag-o' => 'fa fa-flag-o',
      'fa fa-flash' => 'fa fa-flash',
      'fa fa-flask' => 'fa fa-flask',
      'fa fa-folder' => 'fa fa-folder',
      'fa fa-folder-o' => 'fa fa-folder-o',
      'fa fa-folder-open' => 'fa fa-folder-open',
      'fa fa-folder-open-o' => 'fa fa-folder-open-o',
      'fa fa-frown-o' => 'fa fa-frown-o',
      'fa fa-gamepad' => 'fa fa-gamepad',
      'fa fa-gavel' => 'fa fa-gavel',
      'fa fa-gear' => 'fa fa-gear',
      'fa fa-gears' => 'fa fa-gears',
      'fa fa-gift' => 'fa fa-gift',
      'fa fa-glass' => 'fa fa-glass',
      'fa fa-globe' => 'fa fa-globe',
      'fa fa-graduation-cap' => 'fa fa-graduation-cap',
      'fa fa-group' => 'fa fa-group',
      'fa fa-hdd-o' => 'fa fa-hdd-o',
      'fa fa-headphones' => 'fa fa-headphones',
      'fa fa-heart' => 'fa fa-heart',
      'fa fa-heart-o' => 'fa fa-heart-o',
      'fa fa-history' => 'fa fa-history',
      'fa fa-home' => 'fa fa-home',
      'fa fa-image' => 'fa fa-image',
      'fa fa-inbox' => 'fa fa-inbox',
      'fa fa-info' => 'fa fa-info',
      'fa fa-info-circle' => 'fa fa-info-circle',
      'fa fa-institution' => 'fa fa-institution',
      'fa fa-key' => 'fa fa-key',
      'fa fa-keyboard-o' => 'fa fa-keyboard-o',
      'fa fa-language' => 'fa fa-language',
      'fa fa-laptop' => 'fa fa-laptop',
      'fa fa-leaf' => 'fa fa-leaf',
      'fa fa-legal' => 'fa fa-legal',
      'fa fa-lemon-o' => 'fa fa-lemon-o',
      'fa fa-level-down' => 'fa fa-level-down',
      'fa fa-level-up' => 'fa fa-level-up',
      'fa fa-life-bouy' => 'fa fa-life-bouy',
      'fa fa-life-buoy' => 'fa fa-life-buoy',
      'fa fa-life-ring' => 'fa fa-life-ring',
      'fa fa-life-saver' => 'fa fa-life-saver',
      'fa fa-lightbulb-o' => 'fa fa-lightbulb-o',
      'fa fa-location-arrow' => 'fa fa-location-arrow',
      'fa fa-lock' => 'fa fa-lock',
      'fa fa-magic' => 'fa fa-magic',
      'fa fa-magnet' => 'fa fa-magnet',
      'fa fa-mail-forward' => 'fa fa-mail-forward',
      'fa fa-mail-reply' => 'fa fa-mail-reply',
      'fa fa-mail-reply-all' => 'fa fa-mail-reply-all',
      'fa fa-male' => 'fa fa-male',
      'fa fa-map-marker' => 'fa fa-map-marker',
      'fa fa-meh-o' => 'fa fa-meh-o',
      'fa fa-microphone' => 'fa fa-microphone',
      'fa fa-microphone-slash' => 'fa fa-microphone-slash',
      'fa fa-minus' => 'fa fa-minus',
      'fa fa-minus-circle' => 'fa fa-minus-circle',
      'fa fa-minus-square' => 'fa fa-minus-square',
      'fa fa-minus-square-o' => 'fa fa-minus-square-o',
      'fa fa-mobile' => 'fa fa-mobile',
      'fa fa-mobile-phone' => 'fa fa-mobile-phone',
      'fa fa-money' => 'fa fa-money',
      'fa fa-moon-o' => 'fa fa-moon-o',
      'fa fa-mortar-board' => 'fa fa-mortar-board',
      'fa fa-music' => 'fa fa-music',
      'fa fa-navicon' => 'fa fa-navicon',
      'fa fa-paper-plane' => 'fa fa-paper-plane',
      'fa fa-paper-plane-o' => 'fa fa-paper-plane-o',
      'fa fa-paw' => 'fa fa-paw',
      'fa fa-pencil' => 'fa fa-pencil',
      'fa fa-pencil-square' => 'fa fa-pencil-square',
      'fa fa-pencil-square-o' => 'fa fa-pencil-square-o',
      'fa fa-phone' => 'fa fa-phone',
      'fa fa-phone-square' => 'fa fa-phone-square',
      'fa fa-photo' => 'fa fa-photo',
      'fa fa-picture-o' => 'fa fa-picture-o',
      'fa fa-plane' => 'fa fa-plane',
      'fa fa-plus' => 'fa fa-plus',
      'fa fa-plus-circle' => 'fa fa-plus-circle',
      'fa fa-plus-square' => 'fa fa-plus-square',
      'fa fa-plus-square-o' => 'fa fa-plus-square-o',
      'fa fa-power-off' => 'fa fa-power-off',
      'fa fa-print' => 'fa fa-print',
      'fa fa-puzzle-piece' => 'fa fa-puzzle-piece',
      'fa fa-qrcode' => 'fa fa-qrcode',
      'fa fa-question' => 'fa fa-question',
      'fa fa-question-circle' => 'fa fa-question-circle',
      'fa fa-quote-left' => 'fa fa-quote-left',
      'fa fa-quote-right' => 'fa fa-quote-right',
      'fa fa-random' => 'fa fa-random',
      'fa fa-recycle' => 'fa fa-recycle',
      'fa fa-refresh' => 'fa fa-refresh',
      'fa fa-remove' => 'fa fa-remove',
      'fa fa-reorder' => 'fa fa-reorder',
      'fa fa-reply' => 'fa fa-reply',
      'fa fa-reply-all' => 'fa fa-reply-all',
      'fa fa-retweet' => 'fa fa-retweet',
      'fa fa-road' => 'fa fa-road',
      'fa fa-rocket' => 'fa fa-rocket',
      'fa fa-rss' => 'fa fa-rss',
      'fa fa-rss-square' => 'fa fa-rss-square',
      'fa fa-search' => 'fa fa-search',
      'fa fa-search-minus' => 'fa fa-search-minus',
      'fa fa-search-plus' => 'fa fa-search-plus',
      'fa fa-send' => 'fa fa-send',
      'fa fa-send-o' => 'fa fa-send-o',
      'fa fa-share' => 'fa fa-share',
      'fa fa-share-alt' => 'fa fa-share-alt',
      'fa fa-share-alt-square' => 'fa fa-share-alt-square',
      'fa fa-share-square' => 'fa fa-share-square',
      'fa fa-share-square-o' => 'fa fa-share-square-o',
      'fa fa-shield' => 'fa fa-shield',
      'fa fa-shopping-cart' => 'fa fa-shopping-cart',
      'fa fa-sign-in' => 'fa fa-sign-in',
      'fa fa-sign-out' => 'fa fa-sign-out',
      'fa fa-signal' => 'fa fa-signal',
      'fa fa-sitemap' => 'fa fa-sitemap',
      'fa fa-sliders' => 'fa fa-sliders',
      'fa fa-smile-o' => 'fa fa-smile-o',
      'fa fa-sort' => 'fa fa-sort',
      'fa fa-sort-alpha-asc' => 'fa fa-sort-alpha-asc',
      'fa fa-sort-alpha-desc' => 'fa fa-sort-alpha-desc',
      'fa fa-sort-amount-asc' => 'fa fa-sort-amount-asc',
      'fa fa-sort-amount-desc' => 'fa fa-sort-amount-desc',
      'fa fa-sort-asc' => 'fa fa-sort-asc',
      'fa fa-sort-desc' => 'fa fa-sort-desc',
      'fa fa-sort-down' => 'fa fa-sort-down',
      'fa fa-sort-numeric-asc' => 'fa fa-sort-numeric-asc',
      'fa fa-sort-numeric-desc' => 'fa fa-sort-numeric-desc',
      'fa fa-sort-up' => 'fa fa-sort-up',
      'fa fa-space-shuttle' => 'fa fa-space-shuttle',
      'fa fa-spinner' => 'fa fa-spinner',
      'fa fa-spoon' => 'fa fa-spoon',
      'fa fa-square' => 'fa fa-square',
      'fa fa-square-o' => 'fa fa-square-o',
      'fa fa-star' => 'fa fa-star',
      'fa fa-star-half' => 'fa fa-star-half',
      'fa fa-star-half-empty' => 'fa fa-star-half-empty',
      'fa fa-star-half-full' => 'fa fa-star-half-full',
      'fa fa-star-half-o' => 'fa fa-star-half-o',
      'fa fa-star-o' => 'fa fa-star-o',
      'fa fa-suitcase' => 'fa fa-suitcase',
      'fa fa-sun-o' => 'fa fa-sun-o',
      'fa fa-support' => 'fa fa-support',
      'fa fa-tablet' => 'fa fa-tablet',
      'fa fa-tachometer' => 'fa fa-tachometer',
      'fa fa-tag' => 'fa fa-tag',
      'fa fa-tags' => 'fa fa-tags',
      'fa fa-tasks' => 'fa fa-tasks',
      'fa fa-taxi' => 'fa fa-taxi',
      'fa fa-terminal' => 'fa fa-terminal',
      'fa fa-thumb-tack' => 'fa fa-thumb-tack',
      'fa fa-thumbs-down' => 'fa fa-thumbs-down',
      'fa fa-thumbs-o-down' => 'fa fa-thumbs-o-down',
      'fa fa-thumbs-o-up' => 'fa fa-thumbs-o-up',
      'fa fa-thumbs-up' => 'fa fa-thumbs-up',
      'fa fa-ticket' => 'fa fa-ticket',
      'fa fa-times' => 'fa fa-times',
      'fa fa-times-circle' => 'fa fa-times-circle',
      'fa fa-times-circle-o' => 'fa fa-times-circle-o',
      'fa fa-tint' => 'fa fa-tint',
      'fa fa-toggle-down' => 'fa fa-toggle-down',
      'fa fa-toggle-left' => 'fa fa-toggle-left',
      'fa fa-toggle-right' => 'fa fa-toggle-right',
      'fa fa-toggle-up' => 'fa fa-toggle-up',
      'fa fa-trash-o' => 'fa fa-trash-o',
      'fa fa-tree' => 'fa fa-tree',
      'fa fa-trophy' => 'fa fa-trophy',
      'fa fa-truck' => 'fa fa-truck',
      'fa fa-umbrella' => 'fa fa-umbrella',
      'fa fa-university' => 'fa fa-university',
      'fa fa-unlock' => 'fa fa-unlock',
      'fa fa-unlock-alt' => 'fa fa-unlock-alt',
      'fa fa-unsorted' => 'fa fa-unsorted',
      'fa fa-upload' => 'fa fa-upload',
      'fa fa-user' => 'fa fa-user',
      'fa fa-users' => 'fa fa-users',
      'fa fa-video-camera' => 'fa fa-video-camera',
      'fa fa-volume-down' => 'fa fa-volume-down',
      'fa fa-volume-off' => 'fa fa-volume-off',
      'fa fa-volume-up' => 'fa fa-volume-up',
      'fa fa-warning' => 'fa fa-warning',
      'fa fa-wheelchair' => 'fa fa-wheelchair',
      'fa fa-wrench' => 'fa fa-wrench',
      'fa fa-file' => 'fa fa-file',
      'fa fa-file-o' => 'fa fa-file-o',
      'fa fa-file-text' => 'fa fa-file-text',
      'fa fa-file-text-o' => 'fa fa-file-text-o',
      'fa fa-bitcoin' => 'fa fa-bitcoin',
      'fa fa-btc' => 'fa fa-btc',
      'fa fa-cny' => 'fa fa-cny',
      'fa fa-dollar' => 'fa fa-dollar',
      'fa fa-eur' => 'fa fa-eur',
      'fa fa-euro' => 'fa fa-euro',
      'fa fa-gbp' => 'fa fa-gbp',
      'fa fa-inr' => 'fa fa-inr',
      'fa fa-jpy' => 'fa fa-jpy',
      'fa fa-krw' => 'fa fa-krw',
      'fa fa-rmb' => 'fa fa-rmb',
      'fa fa-rouble' => 'fa fa-rouble',
      'fa fa-rub' => 'fa fa-rub',
      'fa fa-ruble' => 'fa fa-ruble',
      'fa fa-rupee' => 'fa fa-rupee',
      'fa fa-try' => 'fa fa-try',
      'fa fa-turkish-lira' => 'fa fa-turkish-lira',
      'fa fa-usd' => 'fa fa-usd',
      'fa fa-won' => 'fa fa-won',
      'fa fa-yen' => 'fa fa-yen',
      'fa fa-align-center' => ' fa fa-align-center',
      'fa fa-align-justify' => 'fa fa-align-justify',
      'fa fa-align-left' => 'fa fa-align-left',
      'fa fa-align-right' => 'fa fa-align-right',
      'fa fa-bold' => 'fa fa-bold',
      'fa fa-chain' => 'fa fa-chain',
      'fa fa-chain-broken' => 'fa fa-chain-broken',
      'fa fa-clipboard' => 'fa fa-clipboard',
      'fa fa-columns' => 'fa fa-columns',
      'fa fa-copy' => 'fa fa-copy',
      'fa fa-cut' => 'fa fa-cut',
      'fa fa-dedent' => 'fa fa-dedent',
      'fa fa-files-o' => 'fa fa-files-o',
      'fa fa-floppy-o' => 'fa fa-floppy-o',
      'fa fa-font' => 'fa fa-font',
      'fa fa-header' => 'fa fa-header',
      'fa fa-indent' => 'fa fa-indent',
      'fa fa-italic' => 'fa fa-italic',
      'fa fa-link' => 'fa fa-link',
      'fa fa-list' => 'fa fa-list',
      'fa fa-list-alt' => 'fa fa-list-alt',
      'fa fa-list-ol' => 'fa fa-list-ol',
      'fa fa-list-ul' => 'fa fa-list-ul',
      'fa fa-outdent' => 'fa fa-outdent',
      'fa fa-paperclip' => 'fa fa-paperclip',
      'fa fa-paragraph' => 'fa fa-paragraph',
      'fa fa-paste' => 'fa fa-paste',
      'fa fa-repeat' => 'fa fa-repeat',
      'fa fa-rotate-left' => 'fa fa-rotate-left',
      'fa fa-rotate-right' => 'fa fa-rotate-right',
      'fa fa-save' => 'fa fa-save',
      'fa fa-scissors' => 'fa fa-scissors',
      'fa fa-strikethrough' => 'fa fa-strikethrough',
      'fa fa-subscript' => 'fa fa-subscript',
      'fa fa-superscript' => 'fa fa-superscript',
      'fa fa-table' => 'fa fa-table',
      'fa fa-text-height' => 'fa fa-text-height',
      'fa fa-text-width' => 'fa fa-text-width',
      'fa fa-th' => 'fa fa-th',
      'fa fa-th-large' => 'fa fa-th-large',
      'fa fa-th-list' => 'fa fa-th-list',
      'fa fa-underline' => 'fa fa-underline',
      'fa fa-undo' => 'fa fa-undo',
      'fa fa-unlink' => 'fa fa-unlink',
      'fa fa-angle-double-down' => ' fa fa-angle-double-down',
      'fa fa-angle-double-left' => 'fa fa-angle-double-left',
      'fa fa-angle-double-right' => 'fa fa-angle-double-right',
      'fa fa-angle-double-up' => 'fa fa-angle-double-up',
      'fa fa-angle-down' => 'fa fa-angle-down',
      'fa fa-angle-left' => 'fa fa-angle-left',
      'fa fa-angle-right' => 'fa fa-angle-right',
      'fa fa-angle-up' => 'fa fa-angle-up',
      'fa fa-arrow-circle-down' => 'fa fa-arrow-circle-down',
      'fa fa-arrow-circle-left' => 'fa fa-arrow-circle-left',
      'fa fa-arrow-circle-o-down' => 'fa fa-arrow-circle-o-down',
      'fa fa-arrow-circle-o-left' => 'fa fa-arrow-circle-o-left',
      'fa fa-arrow-circle-o-right' => 'fa fa-arrow-circle-o-right',
      'fa fa-arrow-circle-o-up' => 'fa fa-arrow-circle-o-up',
      'fa fa-arrow-circle-right' => 'fa fa-arrow-circle-right',
      'fa fa-arrow-circle-up' => 'fa fa-arrow-circle-up',
      'fa fa-arrow-down' => 'fa fa-arrow-down',
      'fa fa-arrow-left' => 'fa fa-arrow-left',
      'fa fa-arrow-right' => 'fa fa-arrow-right',
      'fa fa-arrow-up' => 'fa fa-arrow-up',
      'fa fa-arrows-alt' => 'fa fa-arrows-alt',
      'fa fa-caret-down' => 'fa fa-caret-down',
      'fa fa-caret-left' => 'fa fa-caret-left',
      'fa fa-caret-right' => 'fa fa-caret-right',
      'fa fa-caret-up' => 'fa fa-caret-up',
      'fa fa-chevron-circle-down' => 'fa fa-chevron-circle-down',
      'fa fa-chevron-circle-left' => 'fa fa-chevron-circle-left',
      'fa fa-chevron-circle-right' => 'fa fa-chevron-circle-right',
      'fa fa-chevron-circle-up' => 'fa fa-chevron-circle-up',
      'fa fa-chevron-down' => 'fa fa-chevron-down',
      'fa fa-chevron-left' => 'fa fa-chevron-left',
      'fa fa-chevron-right' => 'fa fa-chevron-right',
      'fa fa-chevron-up' => 'fa fa-chevron-up',
      'fa fa-hand-o-down' => 'fa fa-hand-o-down',
      'fa fa-hand-o-left' => 'fa fa-hand-o-left',
      'fa fa-hand-o-right' => 'fa fa-hand-o-right',
      'fa fa-hand-o-up' => 'fa fa-hand-o-up',
      'fa fa-long-arrow-down' => 'fa fa-long-arrow-down',
      'fa fa-long-arrow-left' => 'fa fa-long-arrow-left',
      'fa fa-long-arrow-right' => 'fa fa-long-arrow-right',
      'fa fa-long-arrow-up' => 'fa fa-long-arrow-up',
      'fa fa-backward' => 'fa fa-backward',
      'fa fa-compress' => 'fa fa-compress',
      'fa fa-eject' => 'fa fa-eject',
      'fa fa-expand' => 'fa fa-expand',
      'fa fa-fast-backward' => 'fa fa-fast-backward',
      'fa fa-fast-forward' => 'fa fa-fast-forward',
      'fa fa-forward' => 'fa fa-forward',
      'fa fa-pause' => 'fa fa-pause',
      'fa fa-play' => 'fa fa-play',
      'fa fa-play-circle' => 'fa fa-play-circle',
      'fa fa-play-circle-o' => 'fa fa-play-circle-o',
      'fa fa-step-backward' => 'fa fa-step-backward',
      'fa fa-step-forward' => 'fa fa-step-forward',
      'fa fa-stop' => 'fa fa-stop',
      'fa fa-youtube-play' => 'fa fa-youtube-play'
    );


      




      /**
      ||-> Metaboxes: For CPT - [testimonial]
      */
      $meta_boxes['testimonials_metaboxs'] = array(
            'id'         => 'testimonials_metaboxs',
            'title'      => __( 'Testimonials Custom Options', 'modeltheme' ),
            'pages'      => array( 'testimonial' ), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
                  array(
                        'name'       => __( 'Job Position', 'modeltheme' ),
                        'desc'       => __( 'Enter testimonial author job position', 'modeltheme' ),
                        'id'         => 'job-position',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'Company', 'modeltheme' ),
                        'desc'       => __( 'Enter testimonial author company name', 'modeltheme' ),
                        'id'         => 'company',
                        'type'       => 'text',
                  )
            ),
      );

      /**
      ||-> Metaboxes: For CPT - Causes]
      */
      $meta_boxes['causes_metaboxs'] = array(
            'id'         => 'causes_metaboxs',
            'title'      => __( 'Causes Custom Options', 'modeltheme' ),
            'pages'      => array( 'cause' ), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
                  array(
                        'name'       => __( 'Post Tagline', 'modeltheme' ),
                        'desc'       => __( 'Enter Cause Post Tagline', 'modeltheme' ),
                        'id'         => 'cause_tagline',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'Target Goal', 'modeltheme' ),
                        'desc'       => __( 'Enter Cause Goal', 'modeltheme' ),
                        'id'         => 'cause_goal',
                        'type'       => 'text',
                  ),
            ),
      );

      /**
      ||-> Metaboxes: For CPT - [member]
      */
      $meta_boxes['members_metaboxs'] = array(
            'id'         => 'members_metaboxs',
            'title'      => __( 'Members Custom Options', 'modeltheme' ),
            'pages'      => array( 'member' ), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
                  array(
                        'name'       => __( 'Job Position', 'modeltheme' ),
                        'id'         => 'av-job-position',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'Facebook URL', 'modeltheme' ),
                        'id'         => 'av-facebook-link',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'Twitter URL', 'modeltheme' ),
                        'id'         => 'av-twitter-link',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'Google Plus URL', 'modeltheme' ),
                        'id'         => 'av-gplus-link',
                        'type'       => 'text',
                  ),
                  array(
                        'name'       => __( 'instagram URL', 'modeltheme' ),
                        'id'         => 'av-instagram-link',
                        'type'       => 'text',
                  ),
            ),
      );


      /**

      ||-> Metaboxes: For - [page]

      */
      // REVSLIDERS
      global $wpdb;
      $limit_small    = 0;
      $limit_high     = 50;
      $tablename      = $wpdb->prefix . "revslider_sliders";
      if($wpdb->get_var("SHOW TABLES LIKE '$tablename'") == $tablename) {
            $sql            = $wpdb->prepare( "SELECT * FROM $tablename LIMIT %d, %d", $limit_small, $limit_high);
            $sliders        = $wpdb->get_results($sql, ARRAY_A);

            $revliders = array(); 
            if ($sliders) {
                  $revliders[] = array(
                        'name'  => 'Please select a slider',
                        'value' => ''
                  );
                  foreach($sliders as $slide){
                        $revliders[] = array(
                              'name'  => $slide['title'],
                              'value' => $slide['alias']
                        );
                  }
            }
      }else{
            $revliders = array(); 
      }


      // SIDEBARS
      $sidebar_options = array();
      $sidebars = $GLOBALS['wp_registered_sidebars'];

      if($sidebars){
            foreach ( $sidebars as $sidebar ){
                  $sidebar_options[] = array(
                        'name'  => $sidebar['name'],
                        'value' => $sidebar['id']
                  );
            }
      }


      $meta_boxes['page_metaboxs'] = array(
            'id'         => 'page_metaboxs',
            'title'      => __( 'Page Custom Options', 'modeltheme' ),
            'pages'      => array( 'page' ), // Post type
            'context'    => 'normal',
            'priority'   => 'high',
            'show_names' => true, // Show field names on the left
            'fields'     => array(
                  /**
                  HEADER
                  */
                  array(
                        'name' => '<h1>Custom Header Options</h1>',
                        'desc' => 'These options replaces the Theme Options for current page.',
                        'type' => 'title',
                        'id' => $prefix . 'test_title'
                  ),

                  array(
                        'name'    => __( 'Rewrite Header Theme Options?', 'modeltheme' ),
                        'desc'    => __( 'If "Yes" - Page Options will rewrite Theme Options', 'modeltheme' ),
                        'id'      => 'ibid_custom_header_options_status',
                        'type'    => 'select',
                        'options' => array(
                            'yes' => __( 'Yes', 'modeltheme' ),
                            'no' => __( 'No', 'modeltheme' ),
                        ),
                        'default' => 'no',
                  ),
                  array(
                        'name' => __( 'Custom Logo', 'modeltheme' ),
                        'desc' => __( 'Import a custom logo for this page only', 'modeltheme' ),
                        'id'   => 'ibid_metabox_header_logo',
                        'type' => 'file',
                        'save_id' => true,
                        'allow' => array( 'url', 'attachment' )
                  ),
                  array(
                      'name'    => 'Select Header Variant',
                      'id'      => 'ibid_header_custom_variant',
                      'type'    => 'radio',
                      'options' => array(
                          '1'        => '<img src="'.plugins_url().'/modeltheme-framework/inc/metaboxes/assets/headers/header_11.jpg" alt="Header v1" />',
                          '2'        => '<img src="'.plugins_url().'/modeltheme-framework/inc/metaboxes/assets/headers/header_2.jpg" alt="Header v2" />',
                          '3'        => '<img src="'.plugins_url().'/modeltheme-framework/inc/metaboxes/assets/headers/header_33.jpg" alt="Header v3" />',
                          '4'        => '<img src="'.plugins_url().'/modeltheme-framework/inc/metaboxes/assets/headers/header_44.jpg" alt="Header v4" />',
                          '5'        => '<img src="'.plugins_url().'/modeltheme-framework/inc/metaboxes/assets/headers/header_55.jpg" alt="Header v5" />',                 
                      ),
                      'default' => 'first_header',
                  ),
                  array(
                        'name'    => __( 'Select Revolution Slider', 'modeltheme' ),
                        'desc'    => __( 'Select an option', 'modeltheme' ),
                        'id'      => 'select_revslider_shortcode',
                        'type'    => 'select',
                        'options' => $revliders,
                        'default' => 'default',
                  ),
                  array(
                        'name'    => __( 'Page title-breadcrumbs', 'modeltheme' ),
                        'desc'    => __( 'Select an option', 'modeltheme' ),
                        'id'      => 'breadcrumbs_on_off',
                        'type'    => 'select',
                        'options' => array(
                              'no' => __( 'Off - Hide title-breadcrumbs area', 'modeltheme' ),
                              'yes' => __( 'On - Show title-breadcrumbs area', 'modeltheme' ),
                        ),
                        'default' => 'yes',
                  ),





                  /**
                  General Page Options
                  */
                  array(
                      'name' => '<h1>General Page Options</h1>',
                      'desc' => 'These options replaces the Theme Options for current page.',
                      'type' => 'title',
                      'id' => $prefix . 'test_title'
                  ),
                  array(
                        'name'    => __( 'Page top/bottom spacing', 'modeltheme' ),
                        'desc'    => __( 'Select an option', 'modeltheme' ),
                        'id'      => 'page_spacing',
                        'type'    => 'select',
                        'options' => array(
                              'high-padding' => __( 'High Padding', 'modeltheme' ),
                              'no-padding' => __( 'No Padding', 'modeltheme' ),
                              'no-padding-top' => __( 'No Padding top', 'modeltheme' ),
                              'no-padding-bottom' => __( 'No Padding bottom', 'modeltheme' ),
                        ),
                        'default' => 'high-padding',
                  ),
                  array(
                        'name'    => __( 'Select Sidebar', 'modeltheme' ),
                        'desc'    => __( 'Select an option', 'modeltheme' ),
                        'id'      => 'select_page_sidebar',
                        'type'    => 'select',
                        'options' => $sidebar_options,
                        'default' => 'default',
                  ),
                  array(
                        'name'    => __( 'Rewrite Global Page Skin Color Theme Option?', 'modeltheme' ),
                        'desc'    => __( 'If "Yes" - This Page Option will rewrite Theme Options', 'modeltheme' ),
                        'id'      => 'ibid_custom_page_skin_color_status',
                        'type'    => 'select',
                        'options' => array(
                            'yes' => __( 'Yes', 'modeltheme' ),
                            'no' => __( 'No', 'modeltheme' ),
                        ),
                        'default' => 'no',
                  ),
                  array(
                        'name'    => __( 'Global Page Skin Color', 'modeltheme' ),
                        'desc'    => __( 'Replaces theme options main color', 'modeltheme' ),
                        'id'      => 'ibid_global_page_color',
                        'type'    => 'colorpicker',
                        'default' => '#00AEEF'
                  ),
                  array(
                        'name'    => __( 'Global Page Skin Color - Hover', 'modeltheme' ),
                        'desc'    => __( 'Replaces theme options main color', 'modeltheme' ),
                        'id'      => 'ibid_global_page_color_hover',
                        'type'    => 'colorpicker',
                        'default' => '#0099d1'
                  ),
                  /**
                  FOOTER
                  */
                  array(
                      'name' => '<h1>Custom Footer Options</h1>',
                      'desc' => 'These options replaces the Theme Options for current page.',
                      'type' => 'title',
                      'id' => $prefix . 'test_title'
                  ),
                  array(
                        'name' => __( 'Disable Footer Row #1', 'modeltheme' ),
                        'desc' => __( 'Check to disable footer row 1 (if enabled from Theme Options Panel)', 'modeltheme' ),
                        'id'   => 'mt_footer_row1_status',
                        'type' => 'checkbox',
                  ),
                  array(
                        'name' => __( 'Disable Footer Row #2', 'modeltheme' ),
                        'desc' => __( 'Check to disable footer row 2 (if enabled from Theme Options Panel)', 'modeltheme' ),
                        'id'   => 'mt_footer_row2_status',
                        'type' => 'checkbox',
                  ),
                  array(
                        'name' => __( 'Disable Footer Row #3', 'modeltheme' ),
                        'desc' => __( 'Check to disable footer row 3 (if enabled from Theme Options Panel)', 'modeltheme' ),
                        'id'   => 'mt_footer_row3_status',
                        'type' => 'checkbox',
                  ),
                  array(
                        'name' => __( 'Disable Footer Bottom Bar', 'modeltheme' ),
                        'desc' => __( 'Check to disable footer bottom copyright bar', 'modeltheme' ),
                        'id'   => 'mt_footer_bottom_bar',
                        'type' => 'checkbox',
                  ),
            ),
      );


    // Add other metaboxes as needed
    return $meta_boxes;
}

?>
<?php 
// Charity Cause meta
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
      add_action( 'woocommerce_product_options_advanced', 'ibid_adv_product_options');
      function ibid_adv_product_options(){
            global $ibid_redux;
            if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {

            global $current_user;
            wp_get_current_user(); 
            $cause = array();
            $cause_posts = get_posts( array( 'post_type' => 'cause', 'posts_per_page' => -1) );

            $cause[''] = __('Select a Charity Cause', 'modeltheme');
            foreach ($cause_posts as $cause_post) {
                  $cause[$cause_post->ID] = $cause_post->post_title;
            }
            echo '<div class="options_group">';
                  woocommerce_wp_select( array(
                        'id'      => 'product_cause',
                        'label'   => __('Charity Cause', 'modeltheme'),
                        'desc_tip' => true,
                        'description' => __('If this auction will be charity auction you can select a cause to support, from the dropdown. Otherwise, leave it unselected.', 'modeltheme'),
                        'options'     => $cause
                  ));
            echo '</div>';
            }
      }
}
// WooCommerce End Date Metabox
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
      add_action( 'woocommerce_product_options_advanced', 'ibid_end_date_product_options');
      function ibid_end_date_product_options(){
         global $ibid_redux;
         global $current_user;
         wp_get_current_user(); 
         if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
               echo '<div class="options_group">';
                  // format: YYYY-MM-DD HH:MM
                  woocommerce_wp_text_input( array(
                     'id'      => 'mt_variable_end_date',
                     'label'   => __('Set end date', 'modeltheme'),
                     'desc_tip' => true,
                     'class'       => 'short ibid-datetimepicker',
                     'wrapper_class' => 'show_if_variable',
                     'description' => __('Select the end period for this product.', 'modeltheme'),
                  ) );
               echo '</div>';
         }
      }
}
// WooCommerce Money Goal Metabox
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
      add_action( 'woocommerce_product_options_advanced', 'ibid_money_goal_product_options');
      function ibid_money_goal_product_options(){
         global $ibid_redux;
         global $current_user;
         wp_get_current_user(); 
         if ($ibid_redux['ibid_enable_fundraising'] == 'enable') {
               echo '<div class="options_group">';
                  woocommerce_wp_text_input( array(
                     'id'      => 'mt_money_goal',
                     'label'   => __('Set money goal (in '. get_woocommerce_currency_symbol().')', 'modeltheme'),
                     'desc_tip' => true,
                     'wrapper_class' => 'show_if_variable',
                     'description' =>__('Select the amount of money for this product', 'modeltheme'),
                  ) );
               echo '</div>';
         }
      }
}

add_action( 'woocommerce_process_product_meta', 'ibid_save_fields', 10, 2 );
function ibid_save_fields( $id, $post ){
      update_post_meta( $id, 'product_cause', $_POST['product_cause'] );
      update_post_meta( $id, 'mt_variable_end_date', $_POST['mt_variable_end_date'] );
      update_post_meta( $id, 'mt_money_goal', $_POST['mt_money_goal'] );
}

//PDF attachment meta
add_action( 'woocommerce_product_options_advanced', 'ibid_pdf_product_options');
function ibid_pdf_product_options(){
      global $ibid_redux;
      echo '<div class="options_group">';
            woocommerce_wp_text_input( array(
                  'id'          => 'ibid_pdf_attach', 
                  'label'       => __( 'Input PDF attachment', 'woocommerce' ), 
                  'placeholder' => '',
                  'desc_tip'    => 'true',
                  'description' => __( 'Add your link to your PDF attachment. This can be downloaded from the single page.', 'woocommerce' ) 
            ));
      echo '</div>';
} 
add_action( 'woocommerce_process_product_meta', 'ibid_save_fields_pdf', 10, 2 );
function ibid_save_fields_pdf( $id, $post ){
      update_post_meta( $id, 'ibid_pdf_attach', $_POST['ibid_pdf_attach'] );
}