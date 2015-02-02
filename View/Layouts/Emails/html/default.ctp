<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html><head>
<title><?php echo $title_for_layout; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
body {
    margin: 0;
    padding: 0;
    min-width: 100%;
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
td {
    padding: 0;
    vertical-align: top;
}
.spacer,
.border {
    font-size: 1px;
    line-height: 1px;
}
img {
    border: 0;
    -ms-interpolation-mode: bicubic;
}
.image {
    font-size: 0;
    Margin-bottom: 24px;
}
.image img {
    display: block;
}
.logo img {
    display: block;
}
strong {
    font-weight: bold;
}
h1,
h2,
h3,
p,
ol,
ul,
li {
    Margin-top: 0;
}
ol,
ul,
li {
    padding-left: 0;
}
.btn a {
    mso-hide: all;
}
blockquote {
    Margin-top: 0;
    Margin-right: 0;
    Margin-bottom: 0;
    padding-right: 0;
}
.column-top {
    font-size: 50px;
    line-height: 50px;
}
.column-bottom {
    font-size: 26px;
    line-height: 26px;
}
.column {
    text-align: left;
}
.contents {
    width: 100%;
}
.padded {
    padding-left: 50px;
    padding-right: 50px;
}
.wrapper {
    background-color: #f1f1f1;
    width: 100%;
    min-width: 620px;
    -webkit-text-size-adjust: 100%;
    -ms-text-size-adjust: 100%;
}
table.wrapper {
    table-layout: fixed;
}
.one-col,
.two-col,
.three-col {
    Margin-left: auto;
    Margin-right: auto;
    width: 600px;
}
.one-col p,
.one-col ol,
.one-col ul {
    Margin-bottom: 24px;
}
.two-col p,
.two-col ol,
.two-col ul {
    Margin-bottom: 21px;
}
.two-col .image {
    Margin-bottom: 21px;
}
.two-col .column-bottom {
    font-size: 29px;
    line-height: 29px;
}
.two-col .column {
    width: 300px;
}
.two-col .first .padded {
    padding-left: 50px;
    padding-right: 25px;
}
.two-col .second .padded {
    padding-left: 25px;
    padding-right: 50px;
}
.three-col p,
.three-col ol,
.three-col ul {
    Margin-bottom: 18px;
}
.three-col .image {
    Margin-bottom: 18px;
}
.three-col .column-bottom {
    font-size: 32px;
    line-height: 32px;
}
.three-col .column {
    width: 200px;
}
.three-col .first .padded {
    padding-left: 50px;
    padding-right: 10px;
}
.three-col .second .padded {
    padding-left: 30px;
    padding-right: 30px;
}
.three-col .third .padded {
    padding-left: 10px;
    padding-right: 50px;
}
.wider {
    width: 400px;
}
.narrower {
    width: 200px;
}
@media only screen and (max-width: 620px) {
    [class*=wrapper] {
        min-width: 320px !important;
        width: 100%!important;
    }
    [class*=wrapper] .one-col,
    [class*=wrapper] .two-col,
    [class*=wrapper] .three-col {
        width: 320px !important;
    }
    [class*=wrapper] .column {
        display: block;
        float: left;
        width: 320px !important;
    }
    [class*=wrapper] .padded {
        padding-left: 20px !important;
        padding-right: 20px !important;
    }
    [class*=wrapper] .full {
        display: none;
    }
    [class*=wrapper] .block {
        display: block !important;
    }
    [class*=wrapper] .hide {
        display: none !important;
    }
    [class*=wrapper] .image {
        margin-bottom: 24px !important;
    }
    [class*=wrapper] .image img {
        height: auto !important;
        width: 100% !important;
    }
}
.wrapper h1,
.wrapper h1 a {
    font-weight: 400;
    letter-spacing: -0.02em;
}
.wrapper h2,
.wrapper h2 a {
    font-weight: 700;
    letter-spacing: -0.01em;
    -webkit-font-smoothing: antialiased;
}
.wrapper h3,
.wrapper h3 a {
    font-weight: 400;
}
.wrapper p,
.wrapper ol,
.wrapper ul {
    text-rendering: optimizeLegibility;
}
.wrapper blockquote {
    font-style: italic;
}
.wrapper .two-col h2,
.wrapper .wider h2 {
    letter-spacing: 0.01em;
}
.border {
    background-color: #e3e3e3;
}
td.border {
    width: 1px;
}
tr.border {
    height: 1px;
}
tr.border td {
    line-height: 1px;
}
.one-col,
.two-col,
.three-col,
.sidebar {
    background-color: #ffffff;
}
.sidebar {
    width: 600px;
}
.first.wider .padded {
    padding-left: 50px;
    padding-right: 30px;
}
.second.wider .padded {
    padding-left: 30px;
    padding-right: 50px;
}
.first.narrower .padded {
    padding-left: 50px;
    padding-right: 10px;
}
.second.narrower .padded {
    padding-left: 10px;
    padding-right: 50px;
}
.divider {
    Margin-bottom: 24px;
}
.wrapper p,
.wrapper ol,
.wrapper ul {
    font-family: sans-serif;
}
.wrapper h1,
.wrapper h2,
.wrapper h3,
.wrapper .btn a,
.wrapper .header .logo,
.wrapper .header .preheader,
.wrapper .footer div,
.wrapper .footer p,
.wrapper .footer .twitter,
.wrapper .footer .facebook,
.wrapper .footer .forward {
    font-family: sans-serif;
}
@media screen and (min-width: 0) {
    .wrapper h1,
    .wrapper h2,
    .wrapper h3,
    .wrapper .btn a,
    .wrapper .header .logo,
    .wrapper .header .preheader,
    .wrapper .footer div,
    .wrapper .footer p,
    .wrapper .footer .twitter,
    .wrapper .footer .facebook,
    .wrapper .footer .forward {
        font-family: Avenir, sans-serif !important;
    }
}
.wrapper a {
    border-bottom: 1px dotted #454545;
    color: #454545;
    font-weight: 600;
    text-decoration: none;
}
.wrapper a:hover {
    border-bottom: 0;
    text-decoration: none;
}
.wrapper h1 {
    color: #3b3e42;
    font-size: 40px;
    line-height: 48px;
    Margin-bottom: 20px;
}
.wrapper h1 a {
    border: none;
}
.wrapper h2 {
    color: #3b3e42;
    font-size: 24px;
    line-height: 32px;
    Margin-bottom: 16px;
}
.wrapper h2 a {
    border: none;
}
.wrapper h3 {
    color: #3b3e42;
    font-size: 18px;
    line-height: 24px;
    Margin-bottom: 12px;
}
.wrapper h3 a {
    border: none;
}
.wrapper p,
.wrapper ol,
.wrapper ul {
    color: #60666d;
}
.wrapper ol,
.wrapper ul {
    Margin-left: 20px;
}
.wrapper li {
    padding-left: 2px;
}
.wrapper blockquote {
    border-left: 4px solid #eceef1;
    Margin: 0;
    padding-left: 18px;
}
.wrapper .btn {
    Margin-bottom: 27px;
}
.wrapper .btn a {
    background-color: #444444;
    border: 0;
    border-radius: 4px;
    box-shadow: 0 3px #111111;
    color: #ffffff;
    display: inline-block;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.04em;
    line-height: 21px;
    padding: 9px 22px 8px 22px;
    text-align: center;
    text-decoration: none;
    text-shadow: 0 1px 0 #111111;
    -webkit-font-smoothing: antialiased;
}
.wrapper .btn a:hover {
    background-color: #222222 !important;
    box-shadow: 0 -3px #000000 !important;
    padding: 7px 22px 10px 22px !important;
    Position: relative;
    top: 3px;
}
.one-col .column table:nth-last-child(2) td h1:last-child,
.one-col .column table:nth-last-child(2) td h2:last-child,
.one-col .column table:nth-last-child(2) td h3:last-child,
.one-col .column table:nth-last-child(2) td p:last-child,
.one-col .column table:nth-last-child(2) td ol:last-child,
.one-col .column table:nth-last-child(2) td ul:last-child {
    Margin-bottom: 24px;
}
.one-col p,
.one-col ol,
.one-col ul {
    font-size: 15px;
    line-height: 24px;
    Margin-bottom: 24px;
}
.wrapper .two-col .column table:nth-last-child(2) td h1:last-child,
.wrapper .wider .column table:nth-last-child(2) td h1:last-child,
.wrapper .two-col .column table:nth-last-child(2) td h2:last-child,
.wrapper .wider .column table:nth-last-child(2) td h2:last-child,
.wrapper .two-col .column table:nth-last-child(2) td h3:last-child,
.wrapper .wider .column table:nth-last-child(2) td h3:last-child,
.wrapper .two-col .column table:nth-last-child(2) td p:last-child,
.wrapper .wider .column table:nth-last-child(2) td p:last-child,
.wrapper .two-col .column table:nth-last-child(2) td ol:last-child,
.wrapper .wider .column table:nth-last-child(2) td ol:last-child,
.wrapper .two-col .column table:nth-last-child(2) td ul:last-child,
.wrapper .wider .column table:nth-last-child(2) td ul:last-child {
    Margin-bottom: 21px;
}
.wrapper .two-col h1,
.wrapper .wider h1 {
    font-size: 28px;
    line-height: 36px;
    Margin-bottom: 18px;
}
.wrapper .two-col h2,
.wrapper .wider h2 {
    font-size: 20px;
    line-height: 28px;
    Margin-bottom: 14px;
}
.wrapper .two-col h3,
.wrapper .wider h3 {
    font-size: 17px;
    line-height: 23px;
    Margin-bottom: 10px;
}
.wrapper .two-col p,
.wrapper .wider p,
.wrapper .two-col ol,
.wrapper .wider ol,
.wrapper .two-col ul,
.wrapper .wider ul {
    font-size: 13px;
    line-height: 21px;
    Margin-bottom: 21px;
}
.wrapper .two-col blockquote,
.wrapper .wider blockquote {
    padding-left: 16px;
}
.wrapper .two-col .divider,
.wrapper .wider .divider {
    Margin-bottom: 21px;
}
.wrapper .two-col .btn,
.wrapper .wider .btn {
    Margin-bottom: 24px;
}
.wrapper .two-col .btn a,
.wrapper .wider .btn a {
    font-size: 12px;
    letter-spacing: 0.014em;
    line-height: 19px;
    padding: 6px 17px 6px 17px;
}
.wrapper .two-col .btn a:hover,
.wrapper .wider .btn a:hover {
    padding: 4px 17px 8px 17px !important;
}
.wrapper .three-col .column table:nth-last-child(2) td h1:last-child,
.wrapper .narrower .column table:nth-last-child(2) td h1:last-child,
.wrapper .three-col .column table:nth-last-child(2) td h2:last-child,
.wrapper .narrower .column table:nth-last-child(2) td h2:last-child,
.wrapper .three-col .column table:nth-last-child(2) td h3:last-child,
.wrapper .narrower .column table:nth-last-child(2) td h3:last-child,
.wrapper .three-col .column table:nth-last-child(2) td p:last-child,
.wrapper .narrower .column table:nth-last-child(2) td p:last-child,
.wrapper .three-col .column table:nth-last-child(2) td ol:last-child,
.wrapper .narrower .column table:nth-last-child(2) td ol:last-child,
.wrapper .three-col .column table:nth-last-child(2) td ul:last-child,
.wrapper .narrower .column table:nth-last-child(2) td ul:last-child {
    Margin-bottom: 18px;
}
.wrapper .three-col h1,
.wrapper .narrower h1 {
    font-size: 24px;
    line-height: 30px;
    Margin-bottom: 16px;
}
.wrapper .three-col h2,
.wrapper .narrower h2 {
    font-size: 18px;
    line-height: 24px;
    Margin-bottom: 12px;
}
.wrapper .three-col h3,
.wrapper .narrower h3 {
    font-size: 15px;
    line-height: 21px;
    Margin-bottom: 8px;
}
.wrapper .three-col p,
.wrapper .narrower p,
.wrapper .three-col ol,
.wrapper .narrower ol,
.wrapper .three-col ul,
.wrapper .narrower ul {
    font-size: 12px;
    line-height: 18px;
    Margin-bottom: 18px;
}
.wrapper .three-col ol,
.wrapper .narrower ol,
.wrapper .three-col ul,
.wrapper .narrower ul {
    Margin-left: 14px;
}
.wrapper .three-col li,
.wrapper .narrower li {
    padding-left: 1px;
}
.wrapper .three-col blockquote,
.wrapper .narrower blockquote {
    border-left-width: 2px;
    padding-left: 12px;
}
.wrapper .three-col .divider,
.wrapper .narrower .divider {
    Margin-bottom: 18px;
}
.wrapper .three-col .btn,
.wrapper .narrower .btn {
    Margin-bottom: 21px;
}
.wrapper .three-col .btn a,
.wrapper .narrower .btn a {
    font-size: 10px;
    letter-spacing: 0.03em;
    line-height: 16px;
    padding: 5px 17px 5px 17px;
}
.wrapper .three-col .btn a:hover,
.wrapper .narrower .btn a:hover {
    padding: 3px 17px 7px 17px !important;
}
.wrapper .wider .column-bottom {
    font-size: 29px;
    line-height: 29px;
}
.wrapper .wider .image {
    Margin-bottom: 21px;
}
.wrapper .narrower .column-bottom {
    font-size: 32px;
    line-height: 32px;
}
.wrapper .narrower .image {
    Margin-bottom: 18px;
}
.header {
    color: #9b9b9b;
    Margin-left: auto;
    Margin-right: auto;
    width: 600px;
}
.header .logo {
    color: #454545;
    font-size: 24px;
    font-weight: 700;
    line-height: 32px;
    padding-bottom: 40px;
    padding-top: 40px;
    text-align: left;
    width: 280px;
}
.header .logo a {
    color: #454545;
    text-decoration: none;
}
.header .preheader {
    font-size: 11px;
    line-height: 17px;
    padding-bottom: 40px;
    padding-top: 40px;
    text-align: right;
    width: 280px;
}
.header .title {
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 0.06em;
    line-height: 16px;
}
.header .webversion {
    font-style: italic;
}
.header .title,
.header .webversion {
    color: #b9b9b9;
}
.header .title a,
.header .webversion a {
    color: #b9b9b9;
}
.footer {
    Margin-right: auto;
    Margin-left: auto;
    width: 602px;
}
.footer table {
    Margin-left: auto;
    Margin-right: auto;
}
.footer div,
.footer p {
    color: #9b9b9b;
    font-size: 11px;
    line-height: 17px;
}
.footer .social td {
    padding-bottom: 30px;
    padding-left: 8px;
    padding-right: 8px;
}
.footer .twitter,
.footer .facebook,
.footer .forward {
    background-color: #e4e3e3;
    background-size: 150px 46px;
    border: 0;
    border-radius: 4px;
    color: #aaa9a9;
    display: inline-block;
    text-transform: uppercase;
    font-size: 10px;
    font-style: normal;
    line-height: 18px;
    mso-hide: all;
    padding-top: 5px;
    padding-bottom: 5px;
    text-shadow: 0 1px 0 rgba(255, 255, 255, 0.2);
    word-break: keep-all;
}
.footer .twitter:hover,
.footer .facebook:hover,
.footer .forward:hover {
    border: 0 !important;
}
.footer .twitter {
    background-image: url(https://i7.createsend1.com/static/eb/master/03-fresh/images/twitter.gif);
    padding-left: 34px;
    padding-right: 15px;
}
.footer .facebook {
    background-image: url(https://i8.createsend1.com/static/eb/master/03-fresh/images/facebook.gif);
    padding-left: 26px;
    padding-right: 15px;
}
.footer .forward {
    background-image: url(https://i9.createsend1.com/static/eb/master/03-fresh/images/forward.gif);
    padding-left: 32px;
    padding-right: 15px;
}
.footer .address a,
.footer .permission a {
    color: #9c9c9c;
    text-decoration: none;
    border: none;
    font-style: normal;
    font-weight: normal;
}
.footer .address {
    Margin-bottom: 19px;
}
.footer .permission {
    Margin-bottom: 10px;
}
.preheader a,
.footer a {
    border-bottom: 1px dotted #9b9b9b;
    color: #9c9c9c;
    font-style: italic;
}
.preheader a:hover,
.footer a:hover {
    border-bottom: 1px dotted #454545 !important;
    color: #454545 !important;
}
@media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2/1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
    [class*=wrapper] .social .twitter {
        background-image: url(https://i1.createsend1.com/static/eb/master/03-fresh/images/twitter-2x.gif) !important;
    }
    [class*=wrapper] .social .facebook {
        background-image: url(https://i10.createsend1.com/static/eb/master/03-fresh/images/facebook-2x.gif) !important;
    }
    [class*=wrapper] .social .forward {
        background-image: url(https://i2.createsend1.com/static/eb/master/03-fresh/images/forward-2x.gif) !important;
    }
}
@media only screen and (max-width: 620px) {
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td h1:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td h1:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td h1:last-child,
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td h2:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td h2:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td h2:last-child,
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td h3:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td h3:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td h3:last-child,
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td p:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td p:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td p:last-child,
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td ol:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td ol:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td ol:last-child,
    [class*=wrapper] .one-col .column:last-child table:nth-last-child(2) td ul:last-child,
    [class*=wrapper] .two-col .column:last-child table:nth-last-child(2) td ul:last-child,
    [class*=wrapper] .three-col .column:last-child table:nth-last-child(2) td ul:last-child {
        Margin-bottom: 24px !important;
    }
    [class*=wrapper] .header,
    [class*=wrapper] .preheader,
    [class*=wrapper] .logo,
    [class*=wrapper] .footer,
    [class*=wrapper] .sidebar {
        width: 320px !important;
    }
    [class*=wrapper] .header .logo {
        padding-bottom: 32px !important;
        padding-top: 12px !important;
        text-align: center !important;
    }
    [class*=wrapper] .header .logo img {
        Margin-left: auto!important;
        Margin-right: auto!important;
        max-width: 260px!important;
        height: auto!important;
    }
    [class*=wrapper] .header .preheader {
        padding-top: 3px !important;
        padding-bottom: 22px !important;
    }
    [class*=wrapper] .header .title {
        display: none!important;
    }
    [class*=wrapper] .header .webversion {
        text-align: center!important;
    }
    [class*=wrapper] .footer .address,
    [class*=wrapper] .footer .permission {
        width: 280px!important;
    }
    [class*=wrapper] h1 {
        font-size: 40px !important;
        line-height: 48px !important;
        Margin-bottom: 20px !important;
    }
    [class*=wrapper] h2 {
        font-size: 24px !important;
        line-height: 32px !important;
        Margin-bottom: 16px !important;
    }
    [class*=wrapper] h3 {
        font-size: 18px !important;
        line-height: 24px !important;
        Margin-bottom: 12px !important;
    }
    [class*=wrapper] .column p,
    [class*=wrapper] .column ol,
    [class*=wrapper] .column ul {
        font-size: 15px !important;
        line-height: 24px !important;
        Margin-bottom: 24px !important;
    }
    [class*=wrapper] ol,
    [class*=wrapper] ul {
        Margin-left: 20px !important;
    }
    [class*=wrapper] li {
        padding-left: 2px !important;
    }
    [class*=wrapper] blockquote {
        border-left-width: 4px !important;
        padding-left: 18px !important;
    }
    [class*=wrapper] .btn,
    [class*=wrapper] .two-col .btn,
    [class*=wrapper] .three-col .btn,
    [class*=wrapper] .narrower .btn,
    [class*=wrapper] .wider .btn {
        Margin-bottom: 27px!important;
    }
    [class*=wrapper] .btn a,
    [class*=wrapper] .two-col .btn a,
    [class*=wrapper] .three-col .btn a,
    [class*=wrapper] .narrower .btn a,
    [class*=wrapper] .wider .btn a {
        display: block !important;
        font-size: 14px !important;
        letter-spacing: 0.04em !important;
        line-height: 21px !important;
        padding: 9px 22px 8px 22px !important;
    }
    [class*=wrapper] .btn a:hover,
    [class*=wrapper] .two-col .btn a:hover,
    [class*=wrapper] .three-col .btn a:hover,
    [class*=wrapper] .narrower .btn a:hover,
    [class*=wrapper] .wider .btn a:hover {
        padding: 7px 22px 10px 22px !important;
    }
    [class*=wrapper] table.border {
        width: 320px !important;
    }
    [class*=wrapper] .divider {
        margin-bottom: 24px !important;
    }
    [class*=wrapper] .column-bottom {
        font-size: 26px !important;
        line-height: 26px !important;
    }
    [class*=wrapper] .first .column-bottom,
    [class*=wrapper] .second .column-top,
    [class*=wrapper] .three-col .second .column-bottom,
    [class*=wrapper] .third .column-top {
        display: none;
    }
    [class*=wrapper] .social td {
        display: block !important;
        text-align: center !important;
    }
}
@media only screen and (max-width: 320px) {
    td[class=border] {
        display: none;
    }
}
</style>
<!--[if mso]>
<style>
    .spacer, .border, .column-top, .column-bottom {
        mso-line-height-rule: exactly;
    }
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow" />
<meta property="og:title" content="<?php echo $title_for_layout; ?>" />
</head>
<body style="margin-top: 0;margin-bottom: 0;margin-left: 0;margin-right: 0;padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;min-width: 100%" bgcolor="#f1f1f1"><style type="text/css">
</style>
<table class="wrapper bg" style="border-collapse: collapse;border-spacing: 0;background-color: #f1f1f1;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
    <tbody><tr>
        <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
            <center>
                <table class="header" style="border-collapse: collapse;border-spacing: 0;color: #9b9b9b;Margin-left: auto;Margin-right: auto;width: 600px">
                    <tbody><tr>
                        <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
                            <table style="border-collapse: collapse;border-spacing: 0" align="right">
                                <tbody><tr>
                                    <td class="preheader" style="padding-top: 40px;padding-bottom: 40px;padding-left: 0;padding-right: 0;vertical-align: top;font-size: 11px;line-height: 17px;text-align: right;width: 280px;font-family: sans-serif">
                                        <div class="spacer" style="font-size: 1px;line-height: 2px">&nbsp;</div>
                                        <div class="title" style="font-size: 11px;font-weight: 500;letter-spacing: 0.06em;line-height: 16px;color: #b9b9b9">ReBadge Services</div>

                                    </td>
                                </tr>
                                </tbody></table>
                            <table style="border-collapse: collapse;border-spacing: 0" align="left">
                                <tbody><tr>
                                    <td class="logo" style="padding-top: 40px;padding-bottom: 40px;padding-left: 0;padding-right: 0;vertical-align: top;color: #454545;font-size: 24px;font-weight: 700;line-height: 32px;text-align: left;width: 280px;font-family: sans-serif" id="emb-email-header"><img style="border-left-width: 0;border-top-width: 0;border-bottom-width: 0;border-right-width: 0;-ms-interpolation-mode: bicubic;display: block;max-width: 210px" src="http://rebadge.services/img/logo-large.png" alt="" width="200" height="60" /></td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
            </center>
        </td>
    </tr>
    </tbody></table>

<?php echo $this->fetch('content'); ?>

<table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #f1f1f1;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
    <tbody><tr>
        <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
            <center>
                <table class="border" style="border-collapse: collapse;border-spacing: 0;font-size: 1px;line-height: 1px;background-color: #e3e3e3;Margin-left: auto;Margin-right: auto" width="602">
                    <tbody><tr><td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">&nbsp;</td></tr>
                    </tbody></table>
            </center>
        </td>
    </tr>
    </tbody></table>

<table class="wrapper" style="border-collapse: collapse;border-spacing: 0;background-color: #f1f1f1;width: 100%;min-width: 620px;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;table-layout: fixed">
    <tbody><tr>
        <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
            <center>
                <table class="footer" style="border-collapse: collapse;border-spacing: 0;Margin-right: auto;Margin-left: auto;width: 602px">
                    <tbody><tr>
                        <td style="padding-top: 0;padding-bottom: 0;padding-left: 0;padding-right: 0;vertical-align: top">
                            <div class="spacer" style="font-size: 11px;line-height: 50px;color: #9b9b9b;font-family: sans-serif">&nbsp;</div>
                            <center>
                                <table class="social" style="border-collapse: collapse;border-spacing: 0;Margin-left: auto;Margin-right: auto">
                                    <tbody><tr>



                                    </tr>
                                    </tbody></table>
                                <div class="address" style="color: #9b9b9b;font-size: 11px;line-height: 17px;Margin-bottom: 19px;font-family: sans-serif">ReBadge / Parklink Development Limited<br />
                                    Allied Kajima Building, 138 Gloucester Road, Wanchai, Hong Kong</div>
                                <div class="permission" style="color: #9b9b9b;font-size: 11px;line-height: 17px;Margin-bottom: 10px;font-family: sans-serif"><?php echo __('You are receiving this email as a client of ReBadge Services.')?></div>
                                <div style="color: #9b9b9b;font-size: 11px;line-height: 17px;font-family: sans-serif">
                      <span class="block">

                      </span>
                      <span class="block">
                        <unsubscribe style="border-bottom:1px dotted #9b9b9b;color:#9b9b9b;font-style:italic;">
                            <?php echo __('Manage your email settings and unsubscribe from any future emails by visiting:')?> <a href="<?php echo $unsubscribe_url?>"><?php echo __('Unsubscribe')?></a>
                        </unsubscribe>
                      </span>
                                </div>
                            </center>
                            <div class="spacer" style="font-size: 11px;line-height: 40px;color: #9b9b9b;font-family: sans-serif">&nbsp;</div>
                        </td>
                    </tr>
                    </tbody></table>
            </center>
        </td>
    </tr>
    </tbody></table>

</body></html>
