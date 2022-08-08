<?php
/*------------------------------------------------------------------
[Table of contents]

1. Recent Tweets
2. Google map
3. Contact Form
5. Testimonials
6. Services style 1
8. Subscribe form
9. Posts calendar
10. Jumbotron
11. Alert
12. Progress bars
13. Panels
14. Responsive YouTube Video
15. Featured post
16. Service style2
17. Skill counter
18. Pricing table
19. Heading with border
21. Testimonials Slider V2
22. Social icons
23. List group
24. Thumbnails custom content
25. Heading with bottom border
26. Call to Action
27. Section Title&Subtitle
28. Blog Posts
29. Masonry banners
30. Sale banner
31. Products by Category

-------------------------------------------------------------------*/
add_action('init','ibid_vc_shortcodes');
function ibid_vc_shortcodes(){
    #FontAwesome icons list
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

      #Animations list
      $animations_list = array(
        'bounce' => 'bounce',
        'flash' => 'flash',
        'pulse' => 'pulse',
        'rubberBand' => 'rubberBand',
        'shake' => 'shake',
        'swing' => 'swing',
        'tada' => 'tada',
        'wobble' => 'wobble',
        'bounceIn' => 'bounceIn',
        'bounceInDown' => 'bounceInDown',
        'bounceInLeft' => 'bounceInLeft',
        'bounceInRight' => 'bounceInRight',
        'bounceInUp' => 'bounceInUp',
        'bounceOut' => 'bounceOut',
        'bounceOutDown' => 'bounceOutDown',
        'bounceOutLeft' => 'bounceOutLeft',
        'bounceOutRight' => 'bounceOutRight',
        'bounceOutUp' => 'bounceOutUp',
        'fadeIn' => 'fadeIn',
        'fadeInDown' => 'fadeInDown',
        'fadeInDownBig' => 'fadeInDownBig',
        'fadeInLeft' => 'fadeInLeft',
        'fadeInLeftBig' => 'fadeInLeftBig',
        'fadeInRight' => 'fadeInRight',
        'fadeInRightBig' => 'fadeInRightBig',
        'fadeInUp' => 'fadeInUp',
        'fadeInUpBig' => 'fadeInUpBig',
        'fadeOut' => 'fadeOut',
        'fadeOutDown' => 'fadeOutDown',
        'fadeOutDownBig' => 'fadeOutDownBig',
        'fadeOutLeft' => 'fadeOutLeft',
        'fadeOutLeftBig' => 'fadeOutLeftBig',
        'fadeOutRight' => 'fadeOutRight',
        'fadeOutRightBi' => 'fadeOutRightBig',
        'fadeOutUp' => 'fadeOutUp',
        'fadeOutUpBig' => 'fadeOutUpBig',
        'flip' => 'flip',
        'flipInX' => 'flipInX',
        'flipInY' => 'flipInY',
        'flipOutX' => 'flipOutX',
        'flipOutY' => 'flipOutY',
        'lightSpeedIn' => 'lightSpeedIn',
        'lightSpeedOut' => 'lightSpeedOut',
        'rotateIn' => 'rotateIn',
        'rotateInDownLe' => 'rotateInDownLeft',
        'rotateInDownRi' => 'rotateInDownRight',
        'rotateInUpLeft' => 'rotateInUpLeft',
        'rotateInUpRigh' => 'rotateInUpRight',
        'rotateOut' => 'rotateOut',
        'rotateOutDownL' => 'rotateOutDownLeft',
        'rotateOutDownR' => 'rotateOutDownRight',
        'rotateOutUpLef' => 'rotateOutUpLeft',
        'rotateOutUpRig' => 'rotateOutUpRight',
        'hinge' => 'hinge',
        'rollIn' => 'rollIn',
        'rollOut' => 'rollOut',
        'zoomIn' => 'zoomIn',
        'zoomInDown' => 'zoomInDown',
        'zoomInLeft' => 'zoomInLeft',
        'zoomInRight' => 'zoomInRight',
        'zoomInUp' => 'zoomInUp',
        'zoomOut' => 'zoomOut',
        'zoomOutDown' => 'zoomOutDown',
        'zoomOutLeft' => 'zoomOutLeft',
        'zoomOutRight' => 'zoomOutRight',
        'zoomOutUp' => 'zoomOutUp'
      );



      if ( function_exists('vc_map') ) {
        // iBid - Contact form
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Contact form", 'modeltheme'),
           "base" => "contact_form",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Contact-form.svg', __FILE__ ),
           "params" => array(
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
          )
        );


        // iBid - Testimonials Slider v2
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Testimonials Slider v2", 'modeltheme'),
           "base" => "testimonials-style2",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/testimonials-slider.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Number of testimonials", 'modeltheme' ),
                  "param_name" => "content",
                  "value" => esc_attr__( "5", "ibid" ),
                  "description" => esc_attr__( "Enter number of testimonials to show.", 'modeltheme' )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Testimonials v1
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Testimonials v1", 'modeltheme'),
           "base" => "testimonials",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/testimonials.svg', __FILE__ ),
           "params" => array(
              array(
                "group" => "Settings",
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              ),
              array(
                "group" => "Settings",
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              ),
              array(
                "group" => "Settings",
                "type" => "dropdown",
                "heading" => esc_attr__("Visible Testimonials per slide", 'modeltheme'),
                "param_name" => "visible_items",
                "value" => array(
                  esc_attr__('1', 'modeltheme')   => '1',
                  esc_attr__('2', 'modeltheme')   => '2',
                  esc_attr__('3', 'modeltheme')   => '3',
                  ),
                "std" => '2',
                "holder" => "div",
                "class" => ""
              ),
              array(
                 "group" => "Styling",
                 "type" => "colorpicker",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Testimonials border color", 'modeltheme'),
                 "param_name" => "testimonial_border_color"
              )
            )
        ));


        // iBid - Service icon with text
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Service icon with text", 'modeltheme'),
           "base" => "service",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/service-icon-with-text.svg', __FILE__ ),
           "params" => array(
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Icon class(FontAwesome)", 'modeltheme'),
                "param_name" => "icon",
                "std" => 'fa fa-youtube-play',
                "holder" => "div",
                "class" => "",
                "value" => $fa_list
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title", 'modeltheme'),
                 "param_name" => "title",
                 "value" => esc_attr__("Graphic Design", 'modeltheme')
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Description", 'modeltheme'),
                 "param_name" => "description",
                 "value" => esc_attr__("Working with us you will work with professional certified designers and engineers having a vast experience.", 'modeltheme')
              )
           )
        ));


        // iBid - Shop feature
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Shop feature", 'modeltheme'),
           "base" => "shop-feature",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Shop-Feature.svg', __FILE__ ),
           "params" => array(
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Icon class(FontAwesome)", 'modeltheme'),
                "param_name" => "icon",
                "std" => 'fa fa-youtube-play',
                "holder" => "div",
                "class" => "",
                "value" => $fa_list
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title", 'modeltheme'),
                 "param_name" => "heading"
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Description", 'modeltheme'),
                 "param_name" => "subheading"
              )
           )
        ));


        // iBid - Posts calendar
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Posts calendar", 'modeltheme'),
           "base" => "posts_calendar",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Posts-Calendar.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Section title", 'modeltheme'),
                 "param_name" => "title",
                 "value" => esc_attr__("Posts calendar", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of posts to show", 'modeltheme'),
                 "param_name" => "number",
                 "value" => esc_attr__("3", 'modeltheme')
              )
           )
        ));


        // iBid - Jumbotron
        vc_map(
          array(
           "name" => esc_attr__("iBid - Jumbotron", 'modeltheme'),
           "base" => "jumbotron",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/map_pins.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Heading", 'modeltheme'),
                 "param_name" => "heading",
                 "value" => esc_attr__("Hello, world!", 'modeltheme')
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Sub heading", 'modeltheme'),
                 "param_name" => "sub_heading",
                 "value" => esc_attr__("This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button text", 'modeltheme'),
                 "param_name" => "button_text",
                 "value" => esc_attr__("Learn more", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button url", 'modeltheme'),
                 "param_name" => "button_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Alert
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Alert", 'modeltheme'),
           "base" => "alert",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Alert.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Alert style", 'modeltheme'),
                 "param_name" => "alert_style",
                 "std" => 'success',
                 "value" => array(
                  'Success'     => 'success',
                  'Info'        => 'info',
                  'Warning'     => 'warning',
                  'Danger'      => 'danger'
                 )
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Is dismissible?", 'modeltheme'),
                 "param_name" => "alert_dismissible",
                 "std" => 'yes',
                 "value" => array(
                  'Yes'    => 'yes',
                  'No'     => 'no'
                  )
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Alert text", 'modeltheme'),
                 "param_name" => "alert_text",
                 "value" => "<strong>Well done!</strong> You successfully read this important alert message."
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Progress bar
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Progress bar", 'modeltheme'),
           "base" => "progress_bar",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/progress-bar.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Progress bar scope", 'modeltheme'),
                 "param_name" => "bar_scope",
                 "std" => 'success',
                 "value" => array(
                  'Success'     => 'success',
                  'Info'        => 'info',
                  'Warning'     => 'warning',
                  'Danger'      => 'danger'
                 )
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Progress bar style", 'modeltheme'),
                 "param_name" => "bar_style",
                 "std" => 'simple',
                 "value" => array(
                  'Simple'     => 'simple',
                  'Striped'    => 'progress-bar-striped'
                 )
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Progress bar value (1-100)", 'modeltheme'),
                 "param_name" => "bar_value",
                 "value" => esc_attr__("40", 'modeltheme')
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Progress bar label", 'modeltheme'),
                 "param_name" => "bar_label",
                 "value" => esc_attr__("40% Complete", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )

           )
        ));


        // iBid - Panel
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Panel", 'modeltheme'),
           "base" => "panel",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Panel.svg', __FILE__ ),
           "params" => array(
                array(
                  "type"         => "dropdown",
                  "holder"       => "div",
                  "class"        => "",
                  "param_name"   => "panel_style",
                  "std"          => 'success',
                  "heading"      => esc_attr__("Panel style", 'modeltheme'),
                  "value"        => array(
                    'Success' => 'success',
                    'Info'    => 'info',
                    'Warning' => 'warning',
                    'Danger'  => 'danger'
                )
              ),
              array(
                 "type"         => "textfield",
                 "holder"       => "div",
                 "class"        => "",
                 "param_name"   => "panel_title",
                 "heading"      => esc_attr__("Panel title", 'modeltheme'),
                 "value"        => esc_attr__("Panel title", 'modeltheme')
              ),
              array(
                 "type"         => "textarea",
                 "holder"       => "div",
                 "class"        => "",
                 "param_name"   => "panel_content",
                 "heading"      => esc_attr__("Panel content", 'modeltheme'),
                 "value"        => esc_attr__("Panel content", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Featured post
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Featured post", 'modeltheme'),
           "base" => "featured_post",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Featured-Post.svg', __FILE__ ),
           "params" => array(
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Section heading icon", 'modeltheme'),
                "param_name" => "icon",
                "std" => 'fa fa-play-circle',
                "holder" => "div",
                "class" => "",
                "value" => $fa_list
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Section title", 'modeltheme'),
                 "param_name" => "title",
                 "value" => esc_attr__("Featured blog post", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Please type a post ID", 'modeltheme'),
                 "param_name" => "postid",
                 "value" => esc_attr__("138", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Service style2
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Service style2", 'modeltheme'),
           "base" => "service_style2",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/service-icon-with-text.svg', __FILE__ ),
           "params" => array(
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Icon class(FontAwesome)", 'modeltheme'),
                "param_name" => "icon",
                "std" => 'fa fa-space-shuttle',
                "holder" => "div",
                "class" => "",
                "value" => $fa_list
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title", 'modeltheme'),
                 "param_name" => "title",
                 "value" => esc_attr__("Graphic Design", 'modeltheme')
              ),
              array(
                 "type" => "textarea",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Description", 'modeltheme'),
                 "param_name" => "description",
                 "value" => esc_attr__("Working with us you will work with professional certified designers and engineers having a vast experience.", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Skill counter
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Skill counter", 'modeltheme'),
           "base" => "mt_skill",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/skill-counter.svg', __FILE__ ),
           "params" => array(
            array(
               "group" => "Options",
               "type" => "dropdown",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Skill media"),
               "param_name" => "icon_or_image",
               "std" => '',
               "description" => esc_attr__("Choose what you want to use: empty/image/icon"),
               "value" => array(
                'Nothing'     => 'choosed_nothing',
                'Use an image'     => 'choosed_image',
                'Use an icon'      => 'choosed_icon'
                )
            ),
            array(
              "group" => "Options",
              "dependency" => array(
               'element' => 'icon_or_image',
               'value' => array( 'choosed_icon' ),
               ),
              "type" => "dropdown",
              "heading" => esc_attr__("Icon class", 'modeltheme'),
              "param_name" => "icon",
              "std" => '',
              "holder" => "div",
              "class" => "",
              "description" => "",
              "value" => $fa_list
            ),
            array(
              "group" => "Options",
              "dependency" => array(
               'element' => 'icon_or_image',
               'value' => array( 'choosed_image' ),
               ),
              "type" => "attach_images",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__( "Choose image", 'modeltheme' ),
              "param_name" => "image_skill",
              "value" => "",
              "description" => esc_attr__( "Choose image for skill", 'modeltheme' )
            ),
            array(
               "group" => "Options",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Title", 'modeltheme'),
               "param_name" => "title",
               "value" => "",
               "description" => ""
            ),
            array(
              "group" => "Styling",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Background Color", 'modeltheme' ),
              "param_name" => "bg_color",
              "value" => "", //Default color
              "description" => esc_attr__( "Choose background color", 'modeltheme' )
            ),
            array(
              "group" => "Styling",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Border Color", 'modeltheme' ),
              "param_name" => "border_color",
              "value" => "", //Default color
              "description" => esc_attr__( "Choose border color", 'modeltheme' )
            ),
            array(
              "group" => "Styling",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Title color", 'modeltheme' ),
              "param_name" => "title_color",
              "value" => "", //Default color
              "description" => esc_attr__( "Choose text color", 'modeltheme' )
            ),
            array(
              "group" => "Styling",
              "type" => "colorpicker",
              "class" => "",
              "heading" => esc_attr__( "Skill value color", 'modeltheme' ),
              "param_name" => "skill_color_value",
              "value" => "", //Default color
              "description" => esc_attr__( "Choose skill value color", 'modeltheme' )
            ),
            array(
               "group" => "Options",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Skill value", 'modeltheme'),
               "param_name" => "skillvalue",
               "value" => "",
               "description" => ""
            ),
            array(
              "group" => "Animation",
              "type" => "dropdown",
              "heading" => esc_attr__("Animation", 'modeltheme'),
              "param_name" => "animation",
              "std" => '',
              "holder" => "div",
              "class" => "",
              "description" => "",
              "value" => $animations_list
            )
         )
        ));


        // iBid - Pricing table
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Pricing table", 'modeltheme'),
           "base" => "pricing-table",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/pricing-table.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package name", 'modeltheme'),
                 "param_name" => "package_name",
                 "value" => esc_attr__("BASIC", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package price", 'modeltheme'),
                 "param_name" => "package_price",
                 "value" => esc_attr__("199", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package currency", 'modeltheme'),
                 "param_name" => "package_currency",
                 "value" => esc_attr__("$", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package basis", 'modeltheme'),
                 "param_name" => "package_basis",
                 "value" => esc_attr__("/ month", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 1st feature", 'modeltheme'),
                 "param_name" => "package_feature1",
                 "value" => esc_attr__("05 Email Account", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 2nd feature", 'modeltheme'),
                 "param_name" => "package_feature2",
                 "value" => esc_attr__("01 Website Layout", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 3rd feature", 'modeltheme'),
                 "param_name" => "package_feature3",
                 "value" => esc_attr__("03 Photo Stock Banner", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 4th feature", 'modeltheme'),
                 "param_name" => "package_feature4",
                 "value" => esc_attr__("01 Javascript Slider", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 5th feature", 'modeltheme'),
                 "param_name" => "package_feature5",
                 "value" => esc_attr__("01 Hosting", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package's 6th feature", 'modeltheme'),
                 "param_name" => "package_feature6",
                 "value" => esc_attr__("01 Domain Name Server", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package button url", 'modeltheme'),
                 "param_name" => "button_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Package button text", 'modeltheme'),
                 "param_name" => "button_text",
                 "value" => esc_attr__("Purchase", 'modeltheme')
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Recommended?", 'modeltheme'),
                "param_name" => "recommended",
                "value" => array(
                  esc_attr__('Simple', 'modeltheme')      => 'simple',
                  esc_attr__('Recommended', 'modeltheme') => 'recommended',
                  ),
                "std" => 'simple',
                "holder" => "div",
                "class" => ""
              )
           )
        ));


        // iBid - Heading with Border
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Heading with Border", 'modeltheme'),
           "base" => "heading-border",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/section-title-heading.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "dropdown",
                "heading" => esc_attr__("Alignment", 'modeltheme'),
                "param_name" => "align",
                "std" => 'left',
                "holder" => "div",
                "class" => "",
                "value" => array(
                    'left' => 'left',
                    'right' => 'right',
                    )
              ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Heading", 'modeltheme' ),
                  "param_name" => "content", // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
                  "value" => "OUR<br>WORK",
                  "description" => esc_attr__( "Enter your heading.", 'modeltheme' )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Social icons
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Social icons", 'modeltheme'),
           "base" => "social_icons",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Social-Icons.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Facebook URL", 'modeltheme' ),
                  "param_name" => "facebook",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your facebook link.", 'modeltheme' )
               ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Twitter URL", 'modeltheme' ),
                  "param_name" => "twitter",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your twitter link.", 'modeltheme' )
               ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Pinterest URL", 'modeltheme' ),
                  "param_name" => "pinterest",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your pinterest link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Google Plus URL", 'modeltheme' ),
                  "param_name" => "googleplus",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your Google+ link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Skype Username", 'modeltheme' ),
                  "param_name" => "skype",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your Skype Username.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Instagram URL", 'modeltheme' ),
                  "param_name" => "instagram",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your instagram link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "YouTube URL", 'modeltheme' ),
                  "param_name" => "youtube",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your YouTube link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "LinkedIn URL", 'modeltheme' ),
                  "param_name" => "linkedin",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your linkedin link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Dribbble URL", 'modeltheme' ),
                  "param_name" => "dribbble",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your dribbble link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Deviantart URL", 'modeltheme' ),
                  "param_name" => "deviantart",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your deviantart link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Digg URL", 'modeltheme' ),
                  "param_name" => "digg",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your digg link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Flickr URL", 'modeltheme' ),
                  "param_name" => "flickr",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your flickr link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Stumbleupon URL", 'modeltheme' ),
                  "param_name" => "stumbleupon",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your stumbleupon link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Tumblr URL", 'modeltheme' ),
                  "param_name" => "tumblr",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your tumblr link.", 'modeltheme' )
              ),
              array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Vimeo URL", 'modeltheme' ),
                  "param_name" => "vimeo",
                  "value" => esc_attr__( "#", "ibid" ),
                  "description" => esc_attr__( "Enter your vimeo link.", 'modeltheme' )
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - List group
        vc_map( 
          array(
           "name" => esc_attr__("iBid - List group", 'modeltheme'),
           "base" => "list_group",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/list-group.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "List group item heading", 'modeltheme' ),
                  "param_name" => "heading",
                  "value" => esc_attr__( "List group item heading", "ibid" )
               ),
               array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "List group item description", 'modeltheme' ),
                  "param_name" => "description",
                  "value" => esc_attr__( "Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.", "ibid" )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Status", 'modeltheme'),
                "param_name" => "active",
                "value" => array(
                  esc_attr__('Active', 'modeltheme')   => 'active',
                  esc_attr__('Normal', 'modeltheme')   => 'normal',
                  ),
                "std" => 'normal',
                "holder" => "div",
                "class" => ""
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));


        // iBid - Button
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Button", 'modeltheme'),
           "base" => "ibid_btn",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/button.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Button text", 'modeltheme' ),
                  "param_name" => "btn_text",
                  "value" => esc_attr__( "Shop now", "ibid" )
               ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Button url", 'modeltheme' ),
                  "param_name" => "btn_url",
                  "value" => esc_attr__( "#", "ibid" )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Button size", 'modeltheme'),
                "param_name" => "btn_size",
                "value" => array(
                  esc_attr__('Small', 'modeltheme')   => 'btn btn-sm',
                  esc_attr__('Medium', 'modeltheme')   => 'btn btn-medium',
                  esc_attr__('Large', 'modeltheme')   => 'btn btn-lg'
                  ),
                "std" => 'normal',
                "holder" => "div",
                "class" => ""
              ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Alignment", 'modeltheme'),
                "param_name" => "align",
                "value" => array(
                  esc_attr__('Left', 'modeltheme')   => 'text-left',
                  esc_attr__('Center', 'modeltheme')   => 'text-center',
                  esc_attr__('Right', 'modeltheme')   => 'text-right'
                  ),
                "std" => 'normal',
                "holder" => "div",
                "class" => ""
              )
           )
        ));


        // iBid - Thumbnails custom content
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Thumbnails custom content", 'modeltheme'),
           "base" => "thumbnails_custom_content",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Thumbnail.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "attach_image",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Image source url", 'modeltheme' ),
                  "param_name" => "image",
                  "value" => esc_attr__( "#", "ibid" )
               ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Heading", 'modeltheme' ),
                  "param_name" => "heading",
                  "value" => esc_attr__( "Thumbnail label", "ibid" )
               ),
               array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Description", 'modeltheme' ),
                  "param_name" => "description",
                  "value" => esc_attr__( "Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.", "ibid" )
               ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Button URL", 'modeltheme' ),
                  "param_name" => "button_url",
                  "value" => esc_attr__( "#", "ibid" )
               ),
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Button text", 'modeltheme' ),
                  "param_name" => "button_text",
                  "value" => esc_attr__( "Button", "ibid" )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Animation", 'modeltheme'),
                "param_name" => "animation",
                "std" => 'fadeInLeft',
                "holder" => "div",
                "class" => "",
                "value" => $animations_list
              )
           )
        ));



        // iBid - Heading with bottom border
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Heading with bottom border", 'modeltheme'),
           "base" => "heading_border_bottom",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/heading.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Heading", 'modeltheme' ),
                  "param_name" => "heading",
                  "value" => esc_attr__( "Our Work", "ibid" )
               ),
              array(
                "type" => "dropdown",
                "heading" => esc_attr__("Heading align(left/right)", 'modeltheme'),
                "param_name" => "text_align",
                "value" => array(
                  esc_attr__('Left', 'modeltheme')   => 'text-left',
                  esc_attr__('Right', 'modeltheme')   => 'text-right',
                  ),
                "std" => 'text-left',
                "holder" => "div",
                "class" => ""
              ),
           )
        ));


        // iBid - Call to Action
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Call to Action", 'modeltheme'),
           "base" => "ibid-call-to-action",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/call-to-action.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Heading", 'modeltheme' ),
                  "param_name" => "heading",
                  "value" => esc_attr__( "ibid Is The Ultimate WordPress Multi-Purpose WordPress Theme!", "ibid" )
               ),
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Heading type", 'modeltheme'),
                 "param_name" => "heading_type",
                 "std" => 'h2',
                 "value" => array(
                  'Heading H1'     => 'h1',
                  'Heading H2'     => 'h2',
                  'Heading H3'     => 'h3',
                  'Heading H4'     => 'h4',
                  'Heading H5'     => 'h5',
                  'Heading H6'     => 'h6'
                 )
              ),
               array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Subheading", 'modeltheme' ),
                  "param_name" => "subheading",
                  "value" => esc_attr__( "Loaded with awesome features like Visual Composer, premium sliders, unlimited colors, advanced theme options & more!", "ibid" )
               ),
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Text align", 'modeltheme'),
                 "param_name" => "align",
                 "std" => 'text-left',
                 "description" => esc_attr__("Text align of Title and subtitle", 'modeltheme'),
                 "value" => array(
                  'Align left'     => 'text-left',
                  'Align center'        => 'text-center',
                  'Align right'     => 'text-right'
                 )
              ),
           )
        ));


        // iBid - Section Title & Subtitle
        vc_map(
          array(
           "name" => __("iBid - Section Title and Subtitle", 'modeltheme'),
           "base" => "heading_title_subtitle",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/section-title-heading.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Section title", 'modeltheme' ),
                  "param_name" => "title",
                  "value" => "OUR <span>SERVICES</span>"
               ),
               array(
                  "type" => "attach_image",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Separator (Optional)", 'modeltheme' ),
                  "description" => esc_attr__("If this option is empty, default theme separator will be applied.", 'modeltheme'),
                  "param_name" => "separator",
               ),
               array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Section subtitle", 'modeltheme' ),
                  "param_name" => "subtitle",
                  "value" => esc_attr__( "We have a lot of opportunities for you. Come check them out!", "ibid" )
               ),
               array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Disable separator?", 'modeltheme'),
                 "param_name" => "disable_sep",
                 "value" => array(
                      'Select Option'               => '',
                      'No'                   => '',
                      'Yes'                  => 'disable_sep'
                     )
                ),
               array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title style", 'modeltheme'),
                 "param_name" => "title_style",
                 "value" => array(
                      'Select Title Style'        => '',
                      'Uppercase'     => '',
                      'Capitalize'    => 'capitalize'
                     )
                ),
               array(
                 "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title Color", 'modeltheme'),
                 "param_name" => "title_color",
                 "value" => array(
                      'Select Title Color'   => '',
                      'Dark'     => '',
                      'Light'    => 'light'
                     )
                ),
               array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Choose Delimitator color", 'modeltheme'),
                  "param_name" => "delimitator_color"
               ),
           )
        ));


        #27. Section Title&Subtitle
        vc_map( 
          array(
           "name" => __("iBid - Section Title and Subtitle w/ button", 'modeltheme'),
           "base" => "heading_title_subtitle_v2",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/section-title-heading.svg', __FILE__ ),
           "params" => array(
               array(
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Section title", 'modeltheme' ),
                  "param_name" => "title",
                  "value" => "OUR <span>SERVICES</span>"
               ),
               array(
                  "type" => "textarea",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Section subtitle", 'modeltheme' ),
                  "param_name" => "subtitle",
                  "value" => esc_attr__( "We have a lot of opportunities for you. Come check them out!", "ibid" )
               ),
               array(
                        "type" => "textfield",
                        "holder" => "div",
                        "class" => "",
                        "heading" => esc_attr__( "Button Text", 'modeltheme'),
                        "param_name" => "button_text",
                        "value" => "",
                        "description" => ""
                ),
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Button Link", 'modeltheme'),
                    "param_name" => "button_link",
                    "value" => "",
                    "description" => ""
                ),
           )
        ));


        $post_category_tax = get_terms('category');
        $post_category = array();
        if ($post_category_tax) {
          foreach ( $post_category_tax as $term ) {
             $post_category[$term->name] = $term->slug;
          }
        }

        // iBid - Blog Posts
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Blog Posts", 'modeltheme'),
           "base" => "ibid-blog-posts",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/blog.svg', __FILE__ ),
           "params" => array(
               array(
                  "group" => "Settings",
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Number", 'modeltheme' ),
                  "param_name" => "number",
                  "value" => esc_attr__( "3", "ibid" )
               ),
               array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Blog Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $post_category
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Columns", 'modeltheme'),
                 "param_name" => "columns",
                 "value" => array(
                  '2 columns'     => 'vc_col-md-6',
                  '3 columns'     => 'vc_col-md-4',
                  '4 columns'     => 'vc_col-md-3'
                 )
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Layout", 'modeltheme'),
                 "param_name" => "layout",
                 "value" => array(
                 'Select Layout'        => '',
                  'Image Left'     => 'image_left',
                  'Image Top'     => 'image_top'
                 )
              ),
              array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Choose overlay color", 'modeltheme'),
                  "param_name" => "overlay_color"
               ),
               array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Choose text color", 'modeltheme'),
                  "param_name" => "text_color"
               )
           )
        ));


        // iBid - Blog Posts Boxed
        vc_map(
          array(
           "name" => esc_attr__("iBid - Blog Posts Boxed", 'modeltheme'),
           "base" => "ibid-blog-boxed",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/blog.svg', __FILE__ ),
           "params" => array(
               array(
                  "group" => "Settings",
                  "type" => "textfield",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Number", 'modeltheme' ),
                  "param_name" => "number",
                  "value" => esc_attr__( "3", "ibid" )
               ),
               array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Blog Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $post_category
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Columns", 'modeltheme'),
                 "param_name" => "columns",
                 "value" => array(
                  '2 columns'     => 'vc_col-md-6',
                  '3 columns'     => 'vc_col-md-4'
                 )
              ),
              array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Choose overlay color", 'modeltheme'),
                  "param_name" => "overlay_color"
               ),
               array(
                  "group" => "Styling",
                  "type" => "colorpicker",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__("Choose text color", 'modeltheme'),
                  "param_name" => "text_color"
               )
           )
        ));


        // iBid - Masonry Banners
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Masonry Banners", 'modeltheme'),
           "base" => "shop-masonry-banners",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/masonry-banners.svg', __FILE__ ),
           "params" => array(
              
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Image", 'modeltheme'),
                 "param_name" => "banner_1_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Title", 'modeltheme'),
                 "param_name" => "banner_1_title",
                 "value" => esc_attr__("Sofas", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_1_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Link", 'modeltheme'),
                 "param_name" => "banner_1_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Image", 'modeltheme'),
                 "param_name" => "banner_2_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Title", 'modeltheme'),
                 "param_name" => "banner_2_title",
                 "value" => esc_attr__("Beds", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_2_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Link", 'modeltheme'),
                 "param_name" => "banner_2_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Image", 'modeltheme'),
                 "param_name" => "banner_3_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Title", 'modeltheme'),
                 "param_name" => "banner_3_title",
                 "value" => esc_attr__("Chairs", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_3_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Link", 'modeltheme'),
                 "param_name" => "banner_3_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#4 Banner Image", 'modeltheme'),
                 "param_name" => "banner_4_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#4 Banner Title", 'modeltheme'),
                 "param_name" => "banner_4_title",
                 "value" => esc_attr__("Chairs", 'modeltheme')
              ),
               array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#4 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_4_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#4 Banner Link", 'modeltheme'),
                 "param_name" => "banner_4_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Styling",
                 "type" => "colorpicker",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Default skin background color", 'modeltheme'),
                 "param_name" => "default_skin_background_color"
              ),
              array(
                 "group" => "Styling",
                 "type" => "colorpicker",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Dark skin background color", 'modeltheme'),
                 "param_name" => "dark_skin_background_color"
              ),
              array(
                 "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button Style", 'modeltheme'),
                 "param_name" => "button_style",
                 "std" => 'round',
                 "value" => array(
                  'Rounded'                 => 'round',
                  'Boxed with Color'        => 'boxed'
                 ),
              ),
           )
        ));  


        // iBid - Domain Masonry Banners
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Domain Masonry Banners", 'modeltheme'),
           "base" => "domain-masonry-banners",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/domains-list.svg', __FILE__ ),
           "params" => array(
              
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Image", 'modeltheme'),
                 "param_name" => "banner_1_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
               array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Prefix", 'modeltheme'),
                 "param_name" => "banner_1_prefix",
                 "value" => esc_attr__(".eu", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Title", 'modeltheme'),
                 "param_name" => "banner_1_title",
                 "value" => esc_attr__("Sofas", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_1_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#1 Banner Link", 'modeltheme'),
                 "param_name" => "banner_1_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Image", 'modeltheme'),
                 "param_name" => "banner_2_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Prefix", 'modeltheme'),
                 "param_name" => "banner_2_prefix",
                 "value" => esc_attr__(".eu", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Title", 'modeltheme'),
                 "param_name" => "banner_2_title",
                 "value" => esc_attr__("Beds", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_2_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#2 Banner Link", 'modeltheme'),
                 "param_name" => "banner_2_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Image", 'modeltheme'),
                 "param_name" => "banner_3_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Prefix", 'modeltheme'),
                 "param_name" => "banner_3_prefix",
                 "value" => esc_attr__(".eu", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Title", 'modeltheme'),
                 "param_name" => "banner_3_title",
                 "value" => esc_attr__("Chairs", 'modeltheme')
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_3_count"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("#3 Banner Link", 'modeltheme'),
                 "param_name" => "banner_3_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
            
              array(
                 "group" => "Styling",
                 "type" => "colorpicker",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Default skin background color", 'modeltheme'),
                 "param_name" => "default_skin_background_color"
              ),
              array(
                 "group" => "Styling",
                 "type" => "colorpicker",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Dark skin background color", 'modeltheme'),
                 "param_name" => "dark_skin_background_color"
              ),
              array(
                 "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button Style", 'modeltheme'),
                 "param_name" => "button_style",
                 "std" => 'round',
                 "value" => array(
                  'Rounded'                 => 'round',
                  'Boxed with Color'        => 'boxed'
                 ),
              ),
           )
        ));


        #30. Sale banner
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Sale Banner", 'modeltheme'),
           "base" => "sale-banner",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Sale-Banner.svg', __FILE__ ),
           "params" => array(
              array(
                 "type" => "attach_image",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Banner Image", 'modeltheme'),
                 "param_name" => "banner_img",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Banner Title", 'modeltheme'),
                 "param_name" => "banner_button_text",
                 "value" => esc_attr__("Read more", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Banner Subtitle", 'modeltheme'),
                 "param_name" => "banner_button_count",
                 "value" => esc_attr__("9 products", 'modeltheme')
              ),
              array(
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Banner url", 'modeltheme'),
                 "param_name" => "banner_button_url",
                 "value" => esc_attr__("#", 'modeltheme')
              ),
              array(
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Title Position", 'modeltheme'),
                 "param_name" => "layout",
                 "std" => '2',
                 "value" => array(
                  'Select Layout'        => '',
                  'Bottom Left'          => 'bottom',
                  'Center'               => 'center',
                  'Half Right'           => 'right'
                 ),
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Title color", 'modeltheme' ),
                "param_name" => "title_color",
                "value" => "" //Default color
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Subtitle color", 'modeltheme' ),
                "param_name" => "subtitle_color",
                "value" => "" //Default color
              ),
           )
        ));  


        // Products Filter Main
        $all_attributes = array();
        if (function_exists('wc_get_attribute_taxonomies')) {
          $attribute_taxonomies = wc_get_attribute_taxonomies();
          if ( $attribute_taxonomies ) {
            foreach ( $attribute_taxonomies as $tax ) {
              $all_attributes[$tax->attribute_name ] = $tax->attribute_name;
            }
          }
        }
        $search_filter = array('Choose' => 'Null','Search Enabled ' => 'search_on', 'Search Disabled' => 'search_off');
        $categories_filter = array('Choose' => 'Null','Categories Enabled ' => 'categories_on', 'Categories Disabled' => 'categories_off');
        $tags_filter = array('Choose' => 'Null','Tags Enabled ' => 'tags_on', 'Tags Disabled' => 'tags_off');

        // iBid - Product Filters
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Product Filters", 'modeltheme'),
           "base" => "product_filters",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Product-Filters.svg', __FILE__ ),
           "params" => array(
            array(
              "group" => "Options",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__( "Number of products", 'modeltheme' ),
              "param_name" => "number",
              "value" => "",
              "description" => esc_attr__( "Enter number of products post to show.", 'modeltheme' )
            ),
            array(
               "group" => "Filters",
               "type" => "checkbox",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Select Products Attributes", 'modeltheme'),
               "param_name" => "attribute",
               "description" => esc_attr__("The selected attributes will be used to filter the products from the left side", 'modeltheme'),
               "std" => 'Default value',
               "value" => $all_attributes,
            ),
            array(
             "group" => "Options",
             "type" => "dropdown",
             "holder" => "div",
             "class" => "",
             "heading" => esc_attr__("Show all products?", 'modeltheme'),
             "param_name" => "all_products",
             "std" => 'true',
             "value" => array(
              'Yes'     => '',
              'No, only auctions'        => 'auction'
             ),
            ),
            array(
              "group" => "Options",
              "type" => "textfield",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__( "Search placeholder", 'modeltheme' ),
              "param_name" => "search_placeholder",
              "value" => "",
              "description" => esc_attr__( "Set the search placeholder.(e.g 'Search Products')", 'modeltheme' )
            ),
            array(
              "group" => "Filters",
              "type" => "dropdown",
              "holder" => "div",
              "heading" => esc_attr__( "Enable or disable search on filter sidebar", 'modeltheme' ),
              "param_name" => "searchfilter",
              "value" => $search_filter,
            ),
            array(
              "group" => "Filters",
              "type" => "dropdown",
              "holder" => "div",
              "heading" => esc_attr__( "Enable or disable categories on filter sidebar", 'modeltheme' ),
              "param_name" => "categoriesfilter",
              "value" => $categories_filter,
            ),
            array(
              "group" => "Filters",
              "type" => "dropdown",
              "holder" => "div",
              "heading" => esc_attr__( "Enable or disable tags on filter sidebar", 'modeltheme' ),
              "param_name" => "tagsfilter",
              "value" => $tags_filter,
            ),
            array(
              "group" => "Animation",
              "type" => "dropdown",
              "heading" => esc_attr__("Animation", 'modeltheme'),
              "param_name" => "animation",
              "std" => 'fadeInLeft',
              "holder" => "div",
              "class" => "",
              "description" => "",
              "value" => $animations_list
            )
          )
        ));



        $product_categories = array();
        if ( class_exists( 'WooCommerce' ) ) {

          $product_categories_tax = get_terms( 'product_cat', array(
            'parent'      => '0'
          ));
          if ($product_categories_tax) {
            foreach ( $product_categories_tax as $term ) {
               $product_categories[$term->name] = $term->slug;
            }
          }
        }

        // iBid - Products List
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Products List", 'modeltheme'),
           "base" => "shop-categories-with-thumbnails",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/Products-List.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of categories to show", 'modeltheme'),
                 "param_name" => "number"
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show for each category", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Show categories without products?", 'modeltheme'),
                 "param_name" => "hide_empty",
                 "std" => 'true',
                 "value" => array(
                  'Yes'     => 'true',
                  'No'        => 'false'
                 ),
              )
           )
        ));

          
        // iBid - Domains List View
        vc_map(
          array(
          "name" => esc_attr__("iBid - Domains List View", 'modeltheme'),
          "base" => "domain-categories",
          "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/domains-list.svg', __FILE__ ),
          "params" => array(
            array(
              "group" => "Settings",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Select Domain Category", 'modeltheme'),
              "param_name" => "category",
              "description" => esc_attr__("Please select blog category", 'modeltheme'),
              "std" => 'Default value',
              "value" => $product_categories
            ),
            array(
               "group" => "Settings",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Number of items to show", 'modeltheme'),
               "param_name" => "number"
            ),
            array(
              "group" => "Settings",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Items Per Row", 'modeltheme'),
              "param_name" => "items_per_row",
              "std" => '',
              "description" => "",
              "value" => array(
                  esc_attr__('1 Items/Row', 'modeltheme')         => 'col-md-12',
                  esc_attr__('2 Items/Row', 'modeltheme')         => 'col-md-6',
              )
            )
         )
        ));

        vc_map(
          array(
          "name" => esc_attr__("iBid - Projects List Type", 'modeltheme'),
          "base" => "projects-list",
          "category" => esc_attr__('iBid', 'modeltheme'),
          "icon" => plugins_url( 'images/projects-list.svg', __FILE__ ),
          "params" => array(
            array(
               "group" => "Settings",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Number of items to show", 'modeltheme'),
               "param_name" => "number"
            ),
            array(
               "group" => "Settings",
               "type" => "textfield",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Custom Button Text", 'modeltheme'),
               "param_name" => "button_text"
            ),
            array(
              "group" => "Settings",
              "type" => "dropdown",
              "holder" => "div",
              "class" => "",
              "heading" => esc_attr__("Items Per Row", 'modeltheme'),
              "param_name" => "items_per_row",
              "std" => '',
              "description" => "",
              "value" => array(
                  esc_attr__('1 Items/Row', 'modeltheme')         => 'col-md-12',
                  esc_attr__('2 Items/Row', 'modeltheme')         => 'col-md-6',
              )
            )
         )
        ));
        
        // iBid - Products Grid
        vc_map( 
          array(
            "name" => esc_attr__("iBid - Products Table (Products Grid)", 'modeltheme'),
            "base" => "shop-categories-with-grids",
            "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/pricing-table.svg', __FILE__ ),
            "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number"
              ),
              array(
                 "group" => "Columns",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: Products Image - width", 'modeltheme'),
                 "param_name" => "product_image_width",
                 "value" => array(
                  'Fullwidth of the cell'        => 'fullwidth',
                  'Small tile'     => 'small_tile',
                 ),
              ),
              array(
                 "group" => "Columns",
                 "type" => "checkbox",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: SKU (Status)", 'modeltheme'),
                 "param_name" => "column_sku",
              ),
              array(
                 "group" => "Columns",
                 "type" => "checkbox",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: Current Bid value/Price (Status)", 'modeltheme'),
                 "param_name" => "column_current_bid_price",
              ),
              array(
                "group" => "Columns",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Column: Current Bid value/Price (Text)", 'modeltheme'),
                "param_name" => "column_current_bid_price_label",
                "description" => __( "This text will replace the default 'Current Bid' text", "my-text-domain" ),
                "dependency" => array(
                    'element' => 'column_current_bid_price',
                    'value' => array( 'true' ),
                ),
              ),
              array(
                 "group" => "Columns",
                 "type" => "checkbox",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: Expires On (Status)", 'modeltheme'),
                 "param_name" => "column_expires_on",
              ),
              array(
                 "group" => "Columns",
                 "type" => "checkbox",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: Stock (Status)", 'modeltheme'),
                 "param_name" => "column_stock",
              ),
              array(
                 "group" => "Columns",
                 "type" => "checkbox",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Column: Place Bid (Status)", 'modeltheme'),
                 "param_name" => "column_place_bid",
              ),
              array(
                "group" => "Columns",
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__("Column: Place Bid (Text)", 'modeltheme'),
                "param_name" => "column_place_bid_label",
                "description" => __( "This text will replace the default 'Place Bid' text.", "my-text-domain" ),
                "dependency" => array(
                    'element' => 'column_place_bid',
                    'value' => array( 'true' ),
                ),
              ),

           )
        ));


        // iBid - Expiring Soon
        vc_map( 
          array(
            "name" => esc_attr__("iBid - Expiring Soon", 'modeltheme'),
            "base" => "shop-expiring-soon",
            "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/Expiring-Soon.svg', __FILE__ ),
            "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "std" => '1',
                 "value" => array(
                  '2'        => '2',
                  '3'        => '3',
                  '4'        => '4'
                 ),
              ),
           )
        ));


        // iBid - Latest Products Boxed
        vc_map(
          array(
           "name" => esc_attr__("iBid - Latest Products Boxed", 'modeltheme'),
           "base" => "shop-products-boxed",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/Latest-Products-Boxed.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Layout Version", 'modeltheme'),
                 "param_name" => "layout",
                 "std" => '2',
                 "value" => array(
                  'Select Layout'         => '',
                  'Style 1'               => 'box-border',
                  'Style 2'               => 'simple',
                  'Style 3'               => 'box-shadow',
                  'Style 4'               => 'v4'
                 ),
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "std" => '2',
                 "value" => array(
                  '2'        => '2',
                  '3'        => '3',
                  '4'        => '4',
                  '6'        => '6',
                 ),
              ),
           )
        ));

        // iBid - Latest Products Boxed
        vc_map(
          array(
           "name" => esc_attr__("iBid - Latest Products Styled", 'modeltheme'),
           "base" => "shop-products-styled",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/Products-Grid.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "std" => '2',
                 "value" => array(
                  '2'        => '2',
                  '3'        => '3',
                  '4'        => '4'
                 ),
              ),
               array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Layout Version", 'modeltheme'),
                 "param_name" => "layout",
                 "std" => '2',
                 "value" => array(
                  'Select Layout'        => '',
                  'Horizontal & Shadow'  => 'horizontal',
                  'Vertical'            => 'vertical',
                  'Vertical Simple'     => 'simple'
                 ),
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background First Product", 'modeltheme' ),
                "param_name" => "product_1",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose background color", 'modeltheme' )
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Second Product", 'modeltheme' ),
                "param_name" => "product_2",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose background color", 'modeltheme' )
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Thirds Product", 'modeltheme' ),
                "param_name" => "product_3",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose background color", 'modeltheme' )
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Fourth Product", 'modeltheme' ),
                "param_name" => "product_4",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose background color", 'modeltheme' )
              ),
           )
        ));

        // iBid - Domains List Grid
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Domains List Grid", 'modeltheme'),
           "base" => "shop-products-domains",
           "category" => esc_attr__('iBid', 'modeltheme'),
           "icon" => plugins_url( 'images/domains-list.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "value" => array(
                  '2'        => 'col-md-6',
                  '3'        => 'col-md-4',
                  '4'        => 'col-md-3'
                 ),
              ),
           )
        ));


        // iBid - Expired Products by Category
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Expired Products by Category", 'modeltheme'),
           "base" => "shop-expired-with-thumbnails",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/countdown.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_categories
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show for each category", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Show categories without products?", 'modeltheme'),
                 "param_name" => "hide_empty",
                 "std" => 'true',
                 "value" => array(
                  'Yes'     => 'true',
                  'No'        => 'false'
                 ),
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "std" => '2',
                 "value" => array(
                  '2'        => '2',
                  '3'        => '3',
                  '4'        => '4'
                 ),
              ),
              array(
                "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button text", 'modeltheme'),
                 "param_name" => "button_text",
                 "description" => esc_attr__("A text to replace the 'View all items' button text", 'modeltheme'),
              ),
              array(
                "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button text", 'modeltheme'),
                 "param_name" => "products_label_text",
                 "description" => esc_attr__("A text to replace the 'Products' label", 'modeltheme'),
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Banner Color 1", 'modeltheme' ),
                "param_name" => "overlay_color1",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose banner color", 'modeltheme' )
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Banner Color 2", 'modeltheme' ),
                "param_name" => "overlay_color2",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose banner color", 'modeltheme' )
              ),
               array(
                  "type" => "attach_image",
                      "group" => "Styling",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Background Image (Optional)", 'modeltheme' ),
                  "description" => esc_attr__("If this option is empty, the colors from colorpickers will be applied.", 'modeltheme'),
                  "param_name" => "bg_image",
               ),
           )
        ));


        #31. Only Categories Boxed

        $category = array();
        $category_title = array();
        if ( class_exists( 'WooCommerce' ) ) {
          $terms = get_terms('product_cat',array('hide_empty' => 0));
          if ($terms) {
            foreach ($terms as $term) {
              $category[$term->slug] = $term->name;
            }
          }

          if ($terms) {
            foreach ($terms as $term) {
              $category_title[$term->name] = $term->slug;
            }
          }
        }

        // iBid - Products Category Image
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Products Category Image", "modeltheme"),
           "base" => "mt_ibid_category_image",
           "category" => esc_attr__('iBid', "modeltheme"),
            "icon" => plugins_url( 'images/Products-Categoy-Image.svg', __FILE__ ),
           "params" => array(
            array(
               "type" => "dropdown",
               "group" => "Options",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Select Listing Base Category Slug", "modeltheme"),
               "param_name" => "category",
               "description" => esc_attr__("Please select listing base category", "modeltheme"),
               "std" => '',
               "value" => $category
            ),
            array(
               "type" => "dropdown",
               "group" => "Options",
               "holder" => "div",
               "class" => "",
               "heading" => esc_attr__("Select Listing Base Category Title", "modeltheme"),
               "param_name" => "category_title",
               "description" => esc_attr__("Please select listing base category", "modeltheme"),
               "std" => '',
               "value" => $category_title
            ),
            array(
                 "group" => "Options",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Layout Version", 'modeltheme'),
                 "param_name" => "layout",
                 "std" => '2',
                 "value" => array(
                  'Select Layout'        => '',
                  'Horizontal & Shadow'        => 'horizontal',
                  'Vertical'            => 'vertical'
                 ),
              ),
            array(
              "group" => "Animation",
              "type" => "dropdown",
              "heading" => esc_attr__("Animation", "modeltheme"),
              "param_name" => "animation",
              "std" => 'fadeInUp',
              "holder" => "div",
              "class" => "",
              "description" => "",
              "value" => $animations_list
            )
          )
        ));


        $product_category = array();
        if ( class_exists( 'WooCommerce' ) ) {
          $product_category_tax = get_terms( 'product_cat', array(
            'parent'      => '0'
          ));
          if ($product_category_tax) {
            foreach ( $product_category_tax as $term ) {
              if ($term) {
                $product_category[$term->name] = $term->slug;
              }
            }
          }
        }

        // iBid - Products by Category v2
        vc_map( 
          array(
           "name" => esc_attr__("iBid - Products by Category v2", 'modeltheme'),
           "base" => "shop-categories-with-xsthumbnails",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/Products-Categoy-Image.svg', __FILE__ ),
           "params" => array(
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_category
              ),
               array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products Layout", 'modeltheme'),
                 "param_name" => "products_layout",
                 "std" => '2',
                 "value" => array(
                  'Select Layout'        => '',
                  'Image Left Aline'        => 'image_left',
                  'Image on top'            => 'image_top'
                 ),
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show for each category", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Show categories without products?", 'modeltheme'),
                 "param_name" => "hide_empty",
                 "std" => 'true',
                 "value" => array(
                  'Yes'     => 'true',
                  'No'        => 'false'
                 ),
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "value" => array(
                  'Select number'        => '',
                  '1'        => '1',
                  '2'        => '2',
                  '3'        => '3',
                  '4'        => '4'
                 ),
              ),
              array(
                "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button text", 'modeltheme'),
                 "param_name" => "button_text",
                 "description" => esc_attr__("A text to replace the 'View all items' button text", 'modeltheme'),
              ),
              array(
                "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button text", 'modeltheme'),
                 "param_name" => "products_label_text",
                 "description" => esc_attr__("A text to replace the 'Products' label", 'modeltheme'),
              ),
              array(
                "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Styles", 'modeltheme'),
                 "param_name" => "styles",
                 "std" => 'rounded',
                 "value" => array(
                    'Select '        => '',
                    'Style 1'        => 'style_1',
                    'Style 2'        => 'style_2'
                   ),
              ),
              array(
                "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Button Styles", 'modeltheme'),
                 "param_name" => "button_style",
                 "std" => 'rounded',
                 "value" => array(
                    'Select Layout'        => '',
                    'Rounded'        => 'rounded',
                    'Boxed with Color'        => 'boxed'
                   ),
              ),
              array(
                "group" => "Styling",
                "type" => "colorpicker",
                "class" => "",
                "heading" => esc_attr__( "Background Banner Color 1", 'modeltheme' ),
                "param_name" => "overlay_color1",
                "value" => "", //Default color
                "description" => esc_attr__( "Choose banner color", 'modeltheme' )
              ),
              array(
                      "group" => "Styling",
                      "type" => "colorpicker",
                      "class" => "",
                      "heading" => esc_attr__( "Background Banner Color 2", 'modeltheme' ),
                      "param_name" => "overlay_color2",
                      "value" => "", //Default color
                      "description" => esc_attr__( "Choose banner color", 'modeltheme' )
              ),
               array(
                  "type" => "attach_image",
                  "group" => "Styling",
                  "holder" => "div",
                  "class" => "",
                  "heading" => esc_attr__( "Background Image (Optional)", 'modeltheme' ),
                  "description" => esc_attr__("If this option is empty, the colors from colorpickers will be applied.", 'modeltheme'),
                  "param_name" => "bg_image",
               ),
               array(
                "group" => "Styling",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Banner Position", 'modeltheme'),
                 "param_name" => "banner_pos",
                 "std" => '',
                 "value" => array(
                    'Select '        => '',
                    'Left'        => '',
                    'Right'        => 'float-right'
                   ),
              ),
           )
        ));

        vc_map( array(
           "name" => __("iBid - Tabs categories"),
           "base" => "mt_tabs_categories",
           "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/tabs.svg', __FILE__ ),
           "params" => array(
            /* CAT 1 */
            array(
                "group" => "First item",
                "type" => "attach_images",
                "holder" => "div",
                "class" => "",
                "heading" => esc_attr__( "Choose icon", 'modeltheme' ),
                "param_name" => "tabs_item_icon1",
                "value" => "",
                "description" => esc_attr__( "Choose icon for first category", 'modeltheme' )
            ),
            array(
                "group"        => "First item",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "tabs_item_title_tab1",
                "heading"      => esc_attr__("Title of column1", 'modeltheme'),
                "description"  => esc_attr__("Enter title of column1", 'modeltheme'),
            ),
            array(
                 "group"       => "First item",
                 "type"        => "dropdown",
                 "holder"      => "div",
                 "class"       => "",
                 "heading"     => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name"  => "tab_category_1",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std"         => 'Default value',
                 "value"       => $product_categories
            ),
            /* CAT 2 */
            array(
                "group"        => "Second item",
                "type"         => "attach_images",
                "holder"       => "div",
                "class"        => "",
                "heading"      => esc_attr__( "Choose icon", 'modeltheme' ),
                "param_name"   => "tabs_item_icon2",
                "value"        => "",
                "description"  => esc_attr__( "Choose icon for first category", 'modeltheme' )
            ),
            array(
                "group"        => "Second item",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "tabs_item_title_tab2",
                "heading"      => esc_attr__("Title of column2", 'modeltheme'),
                "description"  => esc_attr__("Enter title of column2", 'modeltheme'),
            ),
            array(
                 "group"       => "Second item",
                 "type"        => "dropdown",
                 "holder"      => "div",
                 "class"       => "",
                 "heading"     => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name"  => "tab_category_2",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std"         => 'Default value',
                 "value"       => $product_categories
            ),
            /* CAT 3 */
            array(
                "group"        => "Third item",
                "type"         => "attach_images",
                "holder"       => "div",
                "class"        => "",
                "heading"      => esc_attr__( "Choose icon", 'modeltheme' ),
                "param_name"   => "tabs_item_icon3",
                "value"        => "",
                "description"  => esc_attr__( "Choose icon for first category", 'modeltheme' )
            ),
            array(
                "group"        => "Third item",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "tabs_item_title_tab3",
                "heading"      => esc_attr__("Title of column3", 'modeltheme'),
                "description"  => esc_attr__("Enter title of column3", 'modeltheme'),
            ),
            array(
                 "group"       => "Third item",
                 "type"        => "dropdown",
                 "holder"      => "div",
                 "class"       => "",
                 "heading"     => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name"  => "tab_category_3",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std"         => 'Default value',
                 "value"       => $product_categories
            ),
            /* CAT 4 */
            array(
                "group"        => "Fourth item",
                "type"         => "attach_images",
                "holder"       => "div",
                "class"        => "",
                "heading"      => esc_attr__( "Choose icon", 'modeltheme' ),
                "param_name"   => "tabs_item_icon4",
                "value"        => "",
                "description"  => esc_attr__( "Choose Fourth for first category", 'modeltheme' )
            ),
            array(
                "group"        => "Fourth item",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "tabs_item_title_tab4",
                "heading"      => esc_attr__("Title of column4", 'modeltheme'),
                "description"  => esc_attr__("Enter title of column4", 'modeltheme'),
            ),
            array(
                "group"        => "Fourth item",
                "type"        => "dropdown",
                 "holder"      => "div",
                 "class"       => "",
                 "heading"     => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name"  => "tab_category_4",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std"         => 'Default value',
                 "value"       => $product_categories
            ),
            /* CAT 5 */
            array(
                "group"        => "Fifth item",
                "type"         => "attach_images",
                "holder"       => "div",
                "class"        => "",
                "heading"      => esc_attr__( "Choose icon", 'modeltheme' ),
                "param_name"   => "tabs_item_icon5",
                "value"        => "",
                "description"  => esc_attr__( "Choose icon for Fifth category", 'modeltheme' )
            ),
            array(
                "group"        => "Fifth item",
                "type"         => "textfield",
                "holder"       => "div",
                "class"        => "",
                "param_name"   => "tabs_item_title_tab5",
                "heading"      => esc_attr__("Title of column5", 'modeltheme'),
                "description"  => esc_attr__("Enter title of column5", 'modeltheme'),
            ),
            array(
                "group"        => "Fifth item",
                "type"        => "dropdown",
                 "holder"      => "div",
                 "class"       => "",
                 "heading"     => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name"  => "tab_category_5",
                 "description" => esc_attr__("Please select blog category", 'modeltheme'),
                 "std"         => 'Default value',
                 "value"       => $product_categories
            ),
          ),
        ));
        
        // iBid - Products Slider
        
          vc_map( 
            array(
              "name" => esc_attr__("iBid - Products Slider", 'modeltheme'),
              "base" => "mt_products_slider",
              "category" => esc_attr__('iBid', 'modeltheme'),
              "icon" => plugins_url( 'images/Products-Carousel.svg', __FILE__ ),
              "params" => array(
                 array(
                      "group" => "Slider Options",
                      "type"         => "dropdown",
                      "holder"       => "div",
                      "class"        => "",
                      "param_name"   => "layout",
                      "std"          => '',
                      "heading"      => esc_attr__("Layout", 'modeltheme'),
                      "description"  => "",
                      "value"        => array(
                         esc_attr__('Select', 'modeltheme') => '',
                          esc_attr__('Top Image', 'modeltheme') => 'top',
                          esc_attr__('Vertical', 'modeltheme')    => 'vertical',
                      )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Number of products", 'modeltheme' ),
                      "param_name" => "number",
                      "value" => "",
                      "description" => esc_attr__( "Enter number of products to show.", 'modeltheme' )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "dropdown",
                      "holder" => "div",
                      "class" => "",
                      "param_name" => "order",
                      "std"          => '',
                      "heading" => esc_attr__( "Order options", 'modeltheme' ),
                      "description" => esc_attr__( "Order ascending or descending by date", 'modeltheme' ),
                      "value"        => array(
                          esc_attr__('Ascending', 'modeltheme') => 'asc',
                          esc_attr__('Descending', 'modeltheme') => 'desc',
                      )
                      
                  ),
                  array(
                      "group" => "Slider Options",
                      "type"         => "dropdown",
                      "holder"       => "div",
                      "class"        => "",
                      "param_name"   => "navigation",
                      "std"          => '',
                      "heading"      => esc_attr__("Navigation", 'modeltheme'),
                      "description"  => "",
                      "value"        => array(
                          esc_attr__('Disabled', 'modeltheme') => 'false',
                          esc_attr__('Enabled', 'modeltheme')    => 'true',
                      )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type"         => "dropdown",
                      "holder"       => "div",
                      "class"        => "",
                      "param_name"   => "pagination",
                      "std"          => '',
                      "heading"      => esc_attr__("Pagination", 'modeltheme'),
                      "description"  => "",
                      "value"        => array(
                          esc_attr__('Disabled', 'modeltheme') => 'false',
                          esc_attr__('Enabled', 'modeltheme')    => 'true',
                      )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type"         => "dropdown",
                      "holder"       => "div",
                      "class"        => "",
                      "param_name"   => "autoPlay",
                      "std"          => '',
                      "heading"      => esc_attr__("Auto Play", 'modeltheme'),
                      "description"  => "",
                      "value"        => array(
                          esc_attr__('Disabled', 'modeltheme') => 'false',
                          esc_attr__('Enabled', 'modeltheme')    => 'true',
                      )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Pagination Speed", 'modeltheme' ),
                      "param_name" => "paginationSpeed",
                      "value" => "",
                      "description" => esc_attr__( "Pagination Speed(Default: 700)", 'modeltheme' )
                  ),
                  
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Slide Speed", 'modeltheme' ),
                      "param_name" => "slideSpeed",
                      "value" => "",
                      "description" => esc_attr__( "Slide Speed(Default: 700)", 'modeltheme' )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Items for Desktops", 'modeltheme' ),
                      "param_name" => "number_desktop",
                      "value" => "",
                      "description" => esc_attr__( "Default - 4", 'modeltheme' )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Items for Tablets", 'modeltheme' ),
                      "param_name" => "number_tablets",
                      "value" => "",
                      "description" => esc_attr__( "Default - 2", 'modeltheme' )
                  ),
                  array(
                      "group" => "Slider Options",
                      "type" => "textfield",
                      "holder" => "div",
                      "class" => "",
                      "heading" => esc_attr__( "Items for Mobile", 'modeltheme' ),
                      "param_name" => "number_mobile",
                      "value" => "",
                      "description" => esc_attr__( "Default - 1", 'modeltheme' )
                  ),
                  array(
                      "group" => "Animation",
                      "type" => "dropdown",
                      "heading" => esc_attr__("Animation", 'modeltheme'),
                      "param_name" => "animation",
                      "std" => '',
                      "holder" => "div",
                      "class" => "",
                      "description" => "",
                      "value" => $animations_list
                  ),
              )
          ));
        


        // iBid - Products Carousel
        vc_map( 
          array(
            "name" => esc_attr__("iBid - Products Carousel", 'modeltheme'),
            "base" => "mt-products-carousel",
            "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/Products-Carousel.svg', __FILE__ ),
            "params" => array(
                array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Select Products Category", 'modeltheme'),
                 "param_name" => "category",
                 "description" => esc_attr__("Please select WooCommerce Category", 'modeltheme'),
                 "std" => 'Default value',
                 "value" => $product_category
              ),
              array(
                 "group" => "Settings",
                 "type" => "textfield",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Number of products to show", 'modeltheme'),
                 "param_name" => "number_of_products_by_category"
              ),
              array(
                 "group" => "Settings",
                 "type" => "dropdown",
                 "holder" => "div",
                 "class" => "",
                 "heading" => esc_attr__("Products per column", 'modeltheme'),
                 "param_name" => "number_of_columns",
                 "value" => array(
                  '2'        => 'col-md-6',
                  '3'        => 'col-md-4',
                  '4'        => 'col-md-3'
                 ),
              ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Number of products", 'modeltheme' ),
                    "param_name" => "number",
                    "value" => "",
                    "description" => esc_attr__( "Enter number of products to show.", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "param_name" => "order",
                    "std"          => '',
                    "heading" => esc_attr__( "Order options", 'modeltheme' ),
                    "description" => esc_attr__( "Order ascending or descending by date", 'modeltheme' ),
                    "value"        => array(
                        esc_attr__('Ascending', 'modeltheme') => 'asc',
                        esc_attr__('Descending', 'modeltheme') => 'desc',
                    )
                    
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "navigation",
                    "std"          => '',
                    "heading"      => esc_attr__("Navigation", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "pagination",
                    "std"          => '',
                    "heading"      => esc_attr__("Pagination", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "autoPlay",
                    "std"          => '',
                    "heading"      => esc_attr__("Auto Play", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Pagination Speed", 'modeltheme' ),
                    "param_name" => "paginationSpeed",
                    "value" => "",
                    "description" => esc_attr__( "Pagination Speed(Default: 700)", 'modeltheme' )
                ),
                
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Slide Speed", 'modeltheme' ),
                    "param_name" => "slideSpeed",
                    "value" => "",
                    "description" => esc_attr__( "Slide Speed(Default: 700)", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Desktops", 'modeltheme' ),
                    "param_name" => "number_desktop",
                    "value" => "",
                    "description" => esc_attr__( "Default - 4", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Tablets", 'modeltheme' ),
                    "param_name" => "number_tablets",
                    "value" => "",
                    "description" => esc_attr__( "Default - 2", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Mobile", 'modeltheme' ),
                    "param_name" => "number_mobile",
                    "value" => "",
                    "description" => esc_attr__( "Default - 1", 'modeltheme' )
                ),
                array(
                    "group" => "Animation",
                    "type" => "dropdown",
                    "heading" => esc_attr__("Animation", 'modeltheme'),
                    "param_name" => "animation",
                    "std" => '',
                    "holder" => "div",
                    "class" => "",
                    "description" => "",
                    "value" => $animations_list
                ),
            )
        ));


        // iBid - Members Slider
        vc_map( 
          array(
            "name" => esc_attr__("iBid - Members Slider", 'modeltheme'),
            "base" => "mt_members_slider",
            "category" => esc_attr__('iBid', 'modeltheme'),
            "icon" => plugins_url( 'images/members-slider.svg', __FILE__ ),
            "params" => array(
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Number of members", 'modeltheme' ),
                    "param_name" => "number",
                    "value" => "",
                    "description" => esc_attr__( "Enter number of members to show.", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "param_name" => "order",
                    "std"          => '',
                    "heading" => esc_attr__( "Order options", 'modeltheme' ),
                    "description" => esc_attr__( "Order ascending or descending by date", 'modeltheme' ),
                    "value"        => array(
                        esc_attr__('Ascending', 'modeltheme') => 'asc',
                        esc_attr__('Descending', 'modeltheme') => 'desc',
                    )
                    
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "navigation",
                    "std"          => '',
                    "heading"      => esc_attr__("Navigation", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "pagination",
                    "std"          => '',
                    "heading"      => esc_attr__("Pagination", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type"         => "dropdown",
                    "holder"       => "div",
                    "class"        => "",
                    "param_name"   => "autoPlay",
                    "std"          => '',
                    "heading"      => esc_attr__("Auto Play", 'modeltheme'),
                    "description"  => "",
                    "value"        => array(
                        esc_attr__('Disabled', 'modeltheme') => 'false',
                        esc_attr__('Enabled', 'modeltheme')    => 'true',
                    )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Pagination Speed", 'modeltheme' ),
                    "param_name" => "paginationSpeed",
                    "value" => "",
                    "description" => esc_attr__( "Pagination Speed(Default: 700)", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Button Text", 'modeltheme' ),
                    "param_name" => "button_text",
                    "value" => "",
                    "description" => esc_attr__( "Enter button text", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Button Link", 'modeltheme' ),
                    "param_name" => "button_link",
                    "value" => "",
                    "description" => esc_attr__( "Enter button link", 'modeltheme' )
                ),
                array(
                      "group" => "Styling",
                      "type" => "colorpicker",
                      "class" => "",
                      "heading" => esc_attr__( "Button Background Color", 'modeltheme' ),
                      "param_name" => "button_background",
                      "value" => "", //Default color
                      "description" => esc_attr__( "Choose button color", 'modeltheme' )
                    ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Slide Speed", 'modeltheme' ),
                    "param_name" => "slideSpeed",
                    "value" => "",
                    "description" => esc_attr__( "Slide Speed(Default: 700)", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Desktops", 'modeltheme' ),
                    "param_name" => "number_desktop",
                    "value" => "",
                    "description" => esc_attr__( "Default - 4", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Tablets", 'modeltheme' ),
                    "param_name" => "number_tablets",
                    "value" => "",
                    "description" => esc_attr__( "Default - 2", 'modeltheme' )
                ),
                array(
                    "group" => "Slider Options",
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => esc_attr__( "Items for Mobile", 'modeltheme' ),
                    "param_name" => "number_mobile",
                    "value" => "",
                    "description" => esc_attr__( "Default - 1", 'modeltheme' )
                ),
                array(
                    "group" => "Animation",
                    "type" => "dropdown",
                    "heading" => esc_attr__("Animation", 'modeltheme'),
                    "param_name" => "animation",
                    "std" => '',
                    "holder" => "div",
                    "class" => "",
                    "description" => "",
                    "value" => $animations_list
                ),
            )
        )); 

      }
    }

   // iBid - CountDown Version 2
  vc_map( 
    array(
     "name" => esc_attr__("iBid - Countdown Version 2", 'modeltheme'),
     "base" => "shortcode_countdown_v2",
     "category" => esc_attr__('iBid', 'modeltheme'),
     "icon" => plugins_url( 'images/countdown.svg', __FILE__ ),
     "params" => array(
        array(
          "type" => "textfield",
          "heading" => __("Extra class name", "modeltheme"),
          "param_name" => "el_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Date", 'modeltheme'),
           "param_name" => "insert_date",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => "Insert date. Format:YYYY-MM-DD"
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
    )
  );

  // iBid - Featured Product
  vc_map( 
    array(
      "name" => esc_attr__("iBid - Featured Auction", 'modeltheme'),
      "base" => "featured_product",
      "category" => esc_attr__('iBid', 'modeltheme'),
     "icon" => plugins_url( 'images/Products-Auctions.svg', __FILE__ ),
      "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Product ID", 'modeltheme' ),
          "param_name" => "select_product",
          "value" => "",
          "description" => esc_attr__( "Enter product ID", 'modeltheme' )
        ),
         array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Subtitle Product", 'modeltheme' ),
          "param_name" => "subtitle_product",
          "value" => "",
          "description" => esc_attr__( "Enter Subtitle Product", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Featured product background color", 'modeltheme' ),
          "param_name" => "background_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product category color", 'modeltheme' ),
          "param_name" => "category_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for categories", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product name color", 'modeltheme' ),
          "param_name" => "product_name_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for product name", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product price color", 'modeltheme' ),
          "param_name" => "price_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for price", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button text", 'modeltheme' ),
          "param_name" => "button_text",
          "value" => "",
          "description" => esc_attr__( "Enter button text", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 1", 'modeltheme' ),
          "param_name" => "button_background_color1",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -1 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 2", 'modeltheme' ),
          "param_name" => "button_background_color2",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -2 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button text color ", 'modeltheme' ),
          "param_name" => "button_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the text color for the button", 'modeltheme' )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));

// iBid - Featured Product
  vc_map( 
    array(
      "name" => esc_attr__("iBid - Featured Simple Product", 'modeltheme'),
      "base" => "featured_simple_product",
      "category" => esc_attr__('iBid', 'modeltheme'),
     "icon" => plugins_url( 'images/Featured-Product.svg', __FILE__ ),
      "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Product ID", 'modeltheme' ),
          "param_name" => "select_product",
          "value" => "",
          "description" => esc_attr__( "Enter product ID", 'modeltheme' )
        ),
         array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Subtitle Product", 'modeltheme' ),
          "param_name" => "subtitle_product",
          "value" => "",
          "description" => esc_attr__( "Enter Subtitle Product", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Featured product background color", 'modeltheme' ),
          "param_name" => "background_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product category color", 'modeltheme' ),
          "param_name" => "category_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for categories", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product name color", 'modeltheme' ),
          "param_name" => "product_name_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for product name", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product price color", 'modeltheme' ),
          "param_name" => "price_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for price", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button text", 'modeltheme' ),
          "param_name" => "button_text",
          "value" => "",
          "description" => esc_attr__( "Enter button text", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 1", 'modeltheme' ),
          "param_name" => "button_background_color1",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -1 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 2", 'modeltheme' ),
          "param_name" => "button_background_color2",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -2 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button text color ", 'modeltheme' ),
          "param_name" => "button_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the text color for the button", 'modeltheme' )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));

  //"iBid - Featured Product - no image
  vc_map( 
    array(
     "name" => esc_attr__("iBid - Featured Auction - no image", 'modeltheme'),
     "base" => "featured_product_no_image",
     "category" => esc_attr__('iBid', 'modeltheme'),
     "icon" => plugins_url( 'images/Products-Auctions.svg', __FILE__ ),
     "params" => array(
        array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Product ID", 'modeltheme' ),
          "param_name" => "select_product",
          "value" => "",
          "description" => esc_attr__( "Enter product ID", 'modeltheme' )
        ),
         array(
          "group" => "Options",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Write Subtitle Product", 'modeltheme' ),
          "param_name" => "subtitle_product",
          "value" => "",
          "description" => esc_attr__( "Enter Subtitle Product", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Featured product background color", 'modeltheme' ),
          "param_name" => "background_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the background color", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product category color", 'modeltheme' ),
          "param_name" => "category_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for categories", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product name color", 'modeltheme' ),
          "param_name" => "product_name_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for product name", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Product price color", 'modeltheme' ),
          "param_name" => "price_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the color for price", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Button text", 'modeltheme' ),
          "param_name" => "button_text",
          "value" => "",
          "description" => esc_attr__( "Enter button text", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 1", 'modeltheme' ),
          "param_name" => "button_background_color1",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -1 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button gradient color - 2", 'modeltheme' ),
          "param_name" => "button_background_color2",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the gradient color -2 for the button", 'modeltheme' )
        ),
        array(
          "group" => "Styling",
          "type" => "colorpicker",
          "class" => "",
          "heading" => esc_attr__( "Button text color ", 'modeltheme' ),
          "param_name" => "button_text_color",
          "value" => "", //Default color
          "description" => esc_attr__( "Pick the text color for the button", 'modeltheme' )
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));
  

  // iBid - Typed Text
  vc_map( 
    array(
      "name" => esc_attr__("iBid - Typed Text", 'modeltheme'),
      "base" => "mt_typed_text",
      "category" => esc_attr__('iBid', 'modeltheme'),
      "icon" => plugins_url( 'images/Typed-Text.svg', __FILE__ ),
      "params" => array(
        array(
           "group" => "Options",
           "type" => "textarea",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Texts", 'modeltheme'),
           "param_name" => "texts",
           "value" => "",
           "description" => "Eg: 'String Text 1', 'String Text 2', 'String Text 3'"
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Font Size", 'modeltheme'),
           "param_name" => "font_size",
           "value" => "",
           "description" => "Eg: 60px"
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Before text", 'modeltheme'),
           "param_name" => "beforetext",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("After text", 'modeltheme'),
           "param_name" => "aftertext",
           "value" => "",
           "description" => ""
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Type Speed", 'modeltheme'),
           "param_name" => "typespeed",
           "value" => "0",
           "description" => "Default: 0"
        ),
        array(
           "group" => "Options",
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Time Before Backspacing", 'modeltheme'),
           "param_name" => "backdelay",
           "value" => "500",
           "description" => "Default: 500 (Which is 0.5s)"
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
         ), 
     )
  ));

  #MT Video
  vc_map( 
    array(
      "name" => esc_attr__("iBid - Video", 'modeltheme'),
      "base" => "shortcode_video",
      "category" => esc_attr__('iBid', 'modeltheme'),
      "icon" => plugins_url( 'images/video-popup.svg', __FILE__ ),
      "params" => array(
        array(
          "group" => "Options",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "button_image",
          "value" => "",
          "description" => esc_attr__( "Choose image for play button", 'modeltheme' )
        ),
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Video source"),
           "param_name" => "video_source",
           "std" => '',
           "description" => esc_attr__(""),
           "value" => array(
            'Youtube'   => 'source_youtube',
            'Vimeo'     => 'source_vimeo',
            )
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'video_source',
           'value' => array( 'source_vimeo' ),
           ),
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Vimeo id link", 'modeltheme'),
           "param_name" => "vimeo_link_id",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
           "group" => "Options",
           "dependency" => array(
           'element' => 'video_source',
           'value' => array( 'source_youtube' ),
           ),
           "type" => "textfield",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Youtube id link", 'modeltheme'),
           "param_name" => "youtube_link_id",
           "value" => esc_attr__("", 'modeltheme'),
           "description" => ""
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
        )));


  # MT Search Form
  vc_map( 
    array(
     "name" => __("iBid - Products and Auctions Search", 'modeltheme'),
     "base" => "mt_ico_search",
     "category" => esc_attr__('iBid', 'modeltheme'),
    "icon" => plugins_url( 'images/Search-Auctions.svg', __FILE__ ),
     "params" => array(
        array(
           "group" => "Options",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("With type", "modeltheme"),
           "param_name" => "width_type",
           "std" => '',
           "description" => esc_attr__("Please choose the with type", "modeltheme"),
           "value" => array(
            esc_attr__('Boxed', 'modeltheme')          => '',
            esc_attr__('Full width', 'modeltheme')     => 'full_with_row',
           )
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Style Variant", 'modeltheme'),
          "param_name" => "mtsearchform_style_variant",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('Style 1', 'modeltheme')         => '',
              esc_attr__('Style 2', 'modeltheme')         => 'mtsearchform-style-v2',
          )
        ),
        array(
          "group" => "Options",
          "type" => "dropdown",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Popular Searches", 'modeltheme'),
          "param_name" => "popular_searches",
          "std" => '',
          "description" => "",
          "value" => array(
              esc_attr__('On / Show', 'modeltheme')         => 'on',
              esc_attr__('Off / Hide', 'modeltheme')         => 'off',
          )
        ),
        array(
          "group" => "Options",
          "type" => "textfield",
          "heading" => __("Extra class name", "modeltheme"),
          "param_name" => "extra_class",
          "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
        ),
        array(
          "group" => "Animation",
          "type" => "dropdown",
          "heading" => esc_attr__("Animation", 'modeltheme'),
          "param_name" => "animation",
          "std" => 'fadeInLeft',
          "holder" => "div",
          "class" => "",
          "description" => "",
          "value" => $animations_list
        )
      )
  ));


  # MT Map Pins
  vc_map( 
    array(
        "name" => esc_attr__("iBid - Map Pins", 'modeltheme'),
        "base" => "mt_map_pins",
        "as_parent" => array('only' => 'mt_map_pins_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "show_settings_on_create" => true,
        "icon" => plugins_url( 'images/Map-Pins.svg', __FILE__ ),
        "category" => esc_attr__('iBid', 'modeltheme'),
        "is_container" => true,
        "params" => array(
            array(
                "type"          => "attach_image",
                "heading"       => esc_attr__( "Background", 'modeltheme' ),
                "param_name"    => "item_image_map",
                "description"   => ""
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", "modeltheme"),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
            ),
            array(
              "group" => "Animation",
              "type" => "dropdown",
              "heading" => esc_attr__("Animation", 'modeltheme'),
              "param_name" => "animation",
              "std" => '',
              "holder" => "div",
              "class" => "",
              "description" => "",
              "value" => $animations_list
          ), 

        ),
        "js_view" => 'VcColumnView'
    )
  );

  // Map Single Point
  vc_map( 
    array(
      "name" => esc_attr__("Map Single Point", 'modeltheme'),
      "base" => "mt_map_pins_item",
      "content_element" => true,
      "as_child" => array('only' => 'mt_map_pins'), // Use only|except attributes to limit parent (separate multiple values with comma)
      "params" => array(
          // add params same as with any other content element
          array(
              "group"        => "General Options",
              "type"         => "textfield",
              "holder"       => "div",
              "class"        => "",
              "param_name"   => "item_title",
              "heading"      => esc_attr__("Title", 'modeltheme'),
              "description"  => esc_attr__("Enter title for current menu item(Eg: Italian Pizza)", 'modeltheme'),
          ),
          array(
              "group"        => "General Options",
              "type"         => "textarea",
              "holder"       => "div",
              "class"        => "",
              "param_name"   => "item_content",
              "heading"      => esc_attr__("Description", 'modeltheme'),
              "description"  => esc_attr__("Enter title for current menu item(Eg: 30x30cm with cheese, onion rings, olives and tomatoes)", 'modeltheme'),
          ),
          array(
              "group"         => "General Options",
              "type"          => "attach_image",
              "holder"        => "div",
              "class"         => "",
              "heading"       => esc_attr__( "Thumbnail", 'modeltheme' ),
              "param_name"    => "item_image",
              "description"   => ""
          ),
          array(
              "group"        => "General Options",
              "type"         => "textfield",
              "holder"       => "div",
              "class"        => "",
              "param_name"   => "coordinates_x",
              "heading"      => esc_attr__("Coordinates on x axis", 'modeltheme'),
              "description"  => esc_attr__("Enter coordinates on x axis in percentange", 'modeltheme'),
          ),
          array(
              "group"        => "General Options",
              "type"         => "textfield",
              "holder"       => "div",
              "class"        => "",
              "param_name"   => "coordinates_y",
              "heading"      => esc_attr__("Coordinates on y axis", 'modeltheme'),
              "description"  => esc_attr__("Enter coordinates on y axis in percentange", 'modeltheme'),
          ),
          array(
              "group" => "Extra Options",
              "type" => "textfield",
              "heading" => __("Extra class name", "modeltheme"),
              "param_name" => "el_class_pin",
              "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "modeltheme")
          )
      )
  ) );


  //Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
  if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
      class WPBakeryShortCode_Mt_map_pins extends WPBakeryShortCodesContainer {
      }
  }
  if ( class_exists( 'WPBakeryShortCode' ) ) {
      class WPBakeryShortCode_Mt_map_pins_Item extends WPBakeryShortCode {
      }
  }

  // iBid - Causes Grid
  vc_map( 
    array(
       "name" => esc_attr__("iBid - Causes Grid", 'modeltheme'),
       "base" => "ibid-cause-posts",
       "category" => esc_attr__('iBid', 'modeltheme'),
       "icon" => plugins_url( 'images/Causes-Grid.svg', __FILE__ ),
       "params" => array(
         array(
            "group" => "Settings",
            "type" => "textfield",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__( "Number", 'modeltheme' ),
            "param_name" => "number",
            "value" => esc_attr__( "3", "ibid" )
         ),
        array(
           "group" => "Settings",
           "type" => "dropdown",
           "holder" => "div",
           "class" => "",
           "heading" => esc_attr__("Columns", 'modeltheme'),
           "param_name" => "columns",
           "value" => array(
            '2 columns'     => 'vc_col-md-6',
            '3 columns'     => 'vc_col-md-4',
            '4 columns'     => 'vc_col-md-3'
           )
        ),
        array(
            "group" => "Styling",
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Choose overlay color", 'modeltheme'),
            "param_name" => "overlay_color"
         ),
         array(
            "group" => "Styling",
            "type" => "colorpicker",
            "holder" => "div",
            "class" => "",
            "heading" => esc_attr__("Choose text color", 'modeltheme'),
            "param_name" => "text_color"
         )
     )
  ));