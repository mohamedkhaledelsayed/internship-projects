<!DOCTYPE html>

<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" lang="{{ LaravelLocalization::getCurrentLocale() }}"
    data-bs-theme-mode="light">
<!--begin::Head-->

<head>
    <base href="" />
    <title>@yield('page_title')</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="" />
    <meta name="keywords"
        content="" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:url" content="https://pointsgo.gamifiersa.com/" />
    <meta property="og:site_name" content="Points Go" />
    <link rel="canonical" href="https://pointsgo.gamifiersa.com/" />
    <link rel="shortcut icon" href="" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('dashboard-assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />

    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <link href="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}"
            rel="stylesheet" type="text/css" />


        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet"
            type="text/css" />
        <link href="{{ asset('dashboard-assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
        <!--begin::Google tag-->
        <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
        <style>
            body, h1, h2, h3, h4, h5, h6 ,th{
                font-family: 'Cairo', Sans-Serif !important;
                text-align: right;
            }
        </style>
        <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
        <script type="text/javascript" async=""
            src="https://www.googletagmanager.com/gtag/js?id=G-L98VPZFG7E&amp;l=dataLayer&amp;cx=c"></script>
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'UA-37564768-1');
        </script>
        <!--end::Google tag-->
        <script>
            // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
            if (window.top != window.self) {
                window.top.location.replace(window.self.location.href);
            }
        </script>
        <style id="apexcharts-css">
            @keyframes opaque {
                0% {
                    opacity: 0
                }

                to {
                    opacity: 1
                }
            }

            @keyframes resizeanim {

                0%,
                to {
                    opacity: 0
                }
            }

            .apexcharts-canvas {
                position: relative;
                user-select: none
            }

            .apexcharts-canvas ::-webkit-scrollbar {
                -webkit-appearance: none;
                width: 6px
            }

            .apexcharts-canvas ::-webkit-scrollbar-thumb {
                border-radius: 4px;
                background-color: rgba(0, 0, 0, .5);
                box-shadow: 0 0 1px rgba(255, 255, 255, .5);
                -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5)
            }

            .apexcharts-inner {
                position: relative
            }

            .apexcharts-text tspan {
                font-family: inherit
            }

            .legend-mouseover-inactive {
                transition: .15s ease all;
                opacity: .2
            }

            .apexcharts-legend-text {
                padding-left: 15px;
                margin-left: -15px;
            }

            .apexcharts-series-collapsed {
                opacity: 0
            }

            .apexcharts-tooltip {
                border-radius: 5px;
                box-shadow: 2px 2px 6px -4px #999;
                cursor: default;
                font-size: 14px;
                left: 62px;
                opacity: 0;
                pointer-events: none;
                position: absolute;
                top: 20px;
                display: flex;
                flex-direction: column;
                overflow: hidden;
                white-space: nowrap;
                z-index: 12;
                transition: .15s ease all
            }

            .apexcharts-tooltip.apexcharts-active {
                opacity: 1;
                transition: .15s ease all
            }

            .apexcharts-tooltip.apexcharts-theme-light {
                border: 1px solid #e3e3e3;
                background: rgba(255, 255, 255, .96)
            }

            .apexcharts-tooltip.apexcharts-theme-dark {
                color: #fff;
                background: rgba(30, 30, 30, .8)
            }

            .apexcharts-tooltip * {
                font-family: inherit
            }

            .apexcharts-tooltip-title {
                padding: 6px;
                font-size: 15px;
                margin-bottom: 4px
            }

            .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
                background: #eceff1;
                border-bottom: 1px solid #ddd
            }

            .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
                background: rgba(0, 0, 0, .7);
                border-bottom: 1px solid #333
            }

            .apexcharts-tooltip-text-goals-value,
            .apexcharts-tooltip-text-y-value,
            .apexcharts-tooltip-text-z-value {
                display: inline-block;
                margin-left: 5px;
                font-weight: 600
            }

            .apexcharts-tooltip-text-goals-label:empty,
            .apexcharts-tooltip-text-goals-value:empty,
            .apexcharts-tooltip-text-y-label:empty,
            .apexcharts-tooltip-text-y-value:empty,
            .apexcharts-tooltip-text-z-value:empty,
            .apexcharts-tooltip-title:empty {
                display: none
            }

            .apexcharts-tooltip-text-goals-label,
            .apexcharts-tooltip-text-goals-value {
                padding: 6px 0 5px
            }

            .apexcharts-tooltip-goals-group,
            .apexcharts-tooltip-text-goals-label,
            .apexcharts-tooltip-text-goals-value {
                display: flex
            }

            .apexcharts-tooltip-text-goals-label:not(:empty),
            .apexcharts-tooltip-text-goals-value:not(:empty) {
                margin-top: -6px
            }

            .apexcharts-tooltip-marker {
                width: 12px;
                height: 12px;
                position: relative;
                top: 0;
                margin-right: 10px;
                border-radius: 50%
            }

            .apexcharts-tooltip-series-group {
                padding: 0 10px;
                display: none;
                text-align: left;
                justify-content: left;
                align-items: center
            }

            .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
                opacity: 1
            }

            .apexcharts-tooltip-series-group.apexcharts-active,
            .apexcharts-tooltip-series-group:last-child {
                padding-bottom: 4px
            }

            .apexcharts-tooltip-series-group-hidden {
                opacity: 0;
                height: 0;
                line-height: 0;
                padding: 0 !important
            }

            .apexcharts-tooltip-y-group {
                padding: 6px 0 5px
            }

            .apexcharts-custom-tooltip,
            .apexcharts-tooltip-box {
                padding: 4px 8px
            }

            .apexcharts-tooltip-boxPlot {
                display: flex;
                flex-direction: column-reverse
            }

            .apexcharts-tooltip-box>div {
                margin: 4px 0
            }

            .apexcharts-tooltip-box span.value {
                font-weight: 700
            }

            .apexcharts-tooltip-rangebar {
                padding: 5px 8px
            }

            .apexcharts-tooltip-rangebar .category {
                font-weight: 600;
                color: #777
            }

            .apexcharts-tooltip-rangebar .series-name {
                font-weight: 700;
                display: block;
                margin-bottom: 5px
            }

            .apexcharts-xaxistooltip,
            .apexcharts-yaxistooltip {
                opacity: 0;
                pointer-events: none;
                color: #373d3f;
                font-size: 13px;
                text-align: center;
                border-radius: 2px;
                position: absolute;
                z-index: 10;
                background: #eceff1;
                border: 1px solid #90a4ae
            }

            .apexcharts-xaxistooltip {
                padding: 9px 10px;
                transition: .15s ease all
            }

            .apexcharts-xaxistooltip.apexcharts-theme-dark {
                background: rgba(0, 0, 0, .7);
                border: 1px solid rgba(0, 0, 0, .5);
                color: #fff
            }

            .apexcharts-xaxistooltip:after,
            .apexcharts-xaxistooltip:before {
                left: 50%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none
            }

            .apexcharts-xaxistooltip:after {
                border-color: transparent;
                border-width: 6px;
                margin-left: -6px
            }

            .apexcharts-xaxistooltip:before {
                border-color: transparent;
                border-width: 7px;
                margin-left: -7px
            }

            .apexcharts-xaxistooltip-bottom:after,
            .apexcharts-xaxistooltip-bottom:before {
                bottom: 100%
            }

            .apexcharts-xaxistooltip-top:after,
            .apexcharts-xaxistooltip-top:before {
                top: 100%
            }

            .apexcharts-xaxistooltip-bottom:after {
                border-bottom-color: #eceff1
            }

            .apexcharts-xaxistooltip-bottom:before {
                border-bottom-color: #90a4ae
            }

            .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after,
            .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
                border-bottom-color: rgba(0, 0, 0, .5)
            }

            .apexcharts-xaxistooltip-top:after {
                border-top-color: #eceff1
            }

            .apexcharts-xaxistooltip-top:before {
                border-top-color: #90a4ae
            }

            .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after,
            .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
                border-top-color: rgba(0, 0, 0, .5)
            }

            .apexcharts-xaxistooltip.apexcharts-active {
                opacity: 1;
                transition: .15s ease all
            }

            .apexcharts-yaxistooltip {
                padding: 4px 10px
            }

            .apexcharts-yaxistooltip.apexcharts-theme-dark {
                background: rgba(0, 0, 0, .7);
                border: 1px solid rgba(0, 0, 0, .5);
                color: #fff
            }

            .apexcharts-yaxistooltip:after,
            .apexcharts-yaxistooltip:before {
                top: 50%;
                border: solid transparent;
                content: " ";
                height: 0;
                width: 0;
                position: absolute;
                pointer-events: none
            }

            .apexcharts-yaxistooltip:after {
                border-color: transparent;
                border-width: 6px;
                margin-top: -6px
            }

            .apexcharts-yaxistooltip:before {
                border-color: transparent;
                border-width: 7px;
                margin-top: -7px
            }

            .apexcharts-yaxistooltip-left:after,
            .apexcharts-yaxistooltip-left:before {
                left: 100%
            }

            .apexcharts-yaxistooltip-right:after,
            .apexcharts-yaxistooltip-right:before {
                right: 100%
            }

            .apexcharts-yaxistooltip-left:after {
                border-left-color: #eceff1
            }

            .apexcharts-yaxistooltip-left:before {
                border-left-color: #90a4ae
            }

            .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after,
            .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
                border-left-color: rgba(0, 0, 0, .5)
            }

            .apexcharts-yaxistooltip-right:after {
                border-right-color: #eceff1
            }

            .apexcharts-yaxistooltip-right:before {
                border-right-color: #90a4ae
            }

            .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after,
            .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
                border-right-color: rgba(0, 0, 0, .5)
            }

            .apexcharts-yaxistooltip.apexcharts-active {
                opacity: 1
            }

            .apexcharts-yaxistooltip-hidden {
                display: none
            }

            .apexcharts-xcrosshairs,
            .apexcharts-ycrosshairs {
                pointer-events: none;
                opacity: 0;
                transition: .15s ease all
            }

            .apexcharts-xcrosshairs.apexcharts-active,
            .apexcharts-ycrosshairs.apexcharts-active {
                opacity: 1;
                transition: .15s ease all
            }

            .apexcharts-ycrosshairs-hidden {
                opacity: 0
            }

            .apexcharts-selection-rect {
                cursor: move
            }

            .svg_select_boundingRect,
            .svg_select_points_rot {
                pointer-events: none;
                opacity: 0;
                visibility: hidden
            }

            .apexcharts-selection-rect+g .svg_select_boundingRect,
            .apexcharts-selection-rect+g .svg_select_points_rot {
                opacity: 0;
                visibility: hidden
            }

            .apexcharts-selection-rect+g .svg_select_points_l,
            .apexcharts-selection-rect+g .svg_select_points_r {
                cursor: ew-resize;
                opacity: 1;
                visibility: visible
            }

            .svg_select_points {
                fill: #efefef;
                stroke: #333;
                rx: 2
            }

            .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
                cursor: crosshair
            }

            .apexcharts-svg.apexcharts-zoomable.hovering-pan {
                cursor: move
            }

            .apexcharts-menu-icon,
            .apexcharts-pan-icon,
            .apexcharts-reset-icon,
            .apexcharts-selection-icon,
            .apexcharts-toolbar-custom-icon,
            .apexcharts-zoom-icon,
            .apexcharts-zoomin-icon,
            .apexcharts-zoomout-icon {
                cursor: pointer;
                width: 20px;
                height: 20px;
                line-height: 24px;
                color: #6e8192;
                text-align: center
            }

            .apexcharts-menu-icon svg,
            .apexcharts-reset-icon svg,
            .apexcharts-zoom-icon svg,
            .apexcharts-zoomin-icon svg,
            .apexcharts-zoomout-icon svg {
                fill: #6e8192
            }

            .apexcharts-selection-icon svg {
                fill: #444;
                transform: scale(.76)
            }

            .apexcharts-theme-dark .apexcharts-menu-icon svg,
            .apexcharts-theme-dark .apexcharts-pan-icon svg,
            .apexcharts-theme-dark .apexcharts-reset-icon svg,
            .apexcharts-theme-dark .apexcharts-selection-icon svg,
            .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg,
            .apexcharts-theme-dark .apexcharts-zoom-icon svg,
            .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
            .apexcharts-theme-dark .apexcharts-zoomout-icon svg {
                fill: #f3f4f5
            }

            .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg,
            .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
            .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg {
                fill: #008ffb
            }

            .apexcharts-theme-light .apexcharts-menu-icon:hover svg,
            .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
            .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
            .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
            .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
            .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg {
                fill: #333
            }

            .apexcharts-menu-icon,
            .apexcharts-selection-icon {
                position: relative
            }

            .apexcharts-reset-icon {
                margin-left: 5px
            }

            .apexcharts-menu-icon,
            .apexcharts-reset-icon,
            .apexcharts-zoom-icon {
                transform: scale(.85)
            }

            .apexcharts-zoomin-icon,
            .apexcharts-zoomout-icon {
                transform: scale(.7)
            }

            .apexcharts-zoomout-icon {
                margin-right: 3px
            }

            .apexcharts-pan-icon {
                transform: scale(.62);
                position: relative;
                left: 1px;
                top: 0
            }

            .apexcharts-pan-icon svg {
                fill: #fff;
                stroke: #6e8192;
                stroke-width: 2
            }

            .apexcharts-pan-icon.apexcharts-selected svg {
                stroke: #008ffb
            }

            .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
                stroke: #333
            }

            .apexcharts-toolbar {
                position: absolute;
                z-index: 11;
                max-width: 176px;
                text-align: right;
                border-radius: 3px;
                padding: 0 6px 2px;
                display: flex;
                justify-content: space-between;
                align-items: center
            }

            .apexcharts-menu {
                background: #fff;
                position: absolute;
                top: 100%;
                border: 1px solid #ddd;
                border-radius: 3px;
                padding: 3px;
                right: 10px;
                opacity: 0;
                min-width: 110px;
                transition: .15s ease all;
                pointer-events: none
            }

            .apexcharts-menu.apexcharts-menu-open {
                opacity: 1;
                pointer-events: all;
                transition: .15s ease all
            }

            .apexcharts-menu-item {
                padding: 6px 7px;
                font-size: 12px;
                cursor: pointer
            }

            .apexcharts-theme-light .apexcharts-menu-item:hover {
                background: #eee
            }

            .apexcharts-theme-dark .apexcharts-menu {
                background: rgba(0, 0, 0, .7);
                color: #fff
            }

            @media screen and (min-width:768px) {
                .apexcharts-canvas:hover .apexcharts-toolbar {
                    opacity: 1
                }
            }

            .apexcharts-canvas .apexcharts-element-hidden,
            .apexcharts-datalabel.apexcharts-element-hidden,
            .apexcharts-hide .apexcharts-series-points {
                opacity: 0
            }

            .apexcharts-hidden-element-shown {
                opacity: 1;
                transition: 0.25s ease all;
            }

            .apexcharts-datalabel,
            .apexcharts-datalabel-label,
            .apexcharts-datalabel-value,
            .apexcharts-datalabels,
            .apexcharts-pie-label {
                cursor: default;
                pointer-events: none
            }

            .apexcharts-pie-label-delay {
                opacity: 0;
                animation-name: opaque;
                animation-duration: .3s;
                animation-fill-mode: forwards;
                animation-timing-function: ease
            }

            .apexcharts-annotation-rect,
            .apexcharts-area-series .apexcharts-area,
            .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
            .apexcharts-gridline,
            .apexcharts-line,
            .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
            .apexcharts-point-annotation-label,
            .apexcharts-radar-series path,
            .apexcharts-radar-series polygon,
            .apexcharts-toolbar svg,
            .apexcharts-tooltip .apexcharts-marker,
            .apexcharts-xaxis-annotation-label,
            .apexcharts-yaxis-annotation-label,
            .apexcharts-zoom-rect {
                pointer-events: none
            }

            .apexcharts-marker {
                transition: .15s ease all
            }

            .resize-triggers {
                animation: 1ms resizeanim;
                visibility: hidden;
                opacity: 0;
                height: 100%;
                width: 100%;
                overflow: hidden
            }

            .contract-trigger:before,
            .resize-triggers,
            .resize-triggers>div {
                content: " ";
                display: block;
                position: absolute;
                top: 0;
                left: 0
            }

            .resize-triggers>div {
                height: 100%;
                width: 100%;
                background: #eee;
                overflow: auto
            }

            .contract-trigger:before {
                overflow: hidden;
                width: 200%;
                height: 200%
            }

            .apexcharts-bar-goals-markers {
                pointer-events: none
            }

            .apexcharts-bar-shadows {
                pointer-events: none
            }

            .apexcharts-rangebar-goals-markers {
                pointer-events: none
            }
        </style>
        <style>
            .osSwitch {
                position: relative;
                display: inline-block;
                width: 34px;
                height: 15.3px
            }

            .osSwitch input {
                opacity: 0;
                width: 0;
                height: 0
            }

            .osSlider {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border-radius: 34px;
                background-color: #93a0b5;
                transition: 0.4s
            }

            .osSlider:before {
                position: absolute;
                content: '';
                height: 13px;
                width: 13px;
                left: 2px;
                bottom: 1px;
                border-radius: 50%;
                background-color: white;
                transition: 0.4s
            }

            input:checked+.sliderGreen {
                background-color: #04d289
            }

            input:checked+.sliderRed {
                background-color: #ff3b30
            }

            input:not(:checked)+.defaultGreen {
                background-color: #04d289
            }

            input:checked+.osSlider:before {
                transform: translateX(17px)
            }
        </style>
        <style>
            @font-face {
                font-family: 'SegoeUI_online_security';
                src: url(chrome-extension://llbcnfanfmjhpedaedhbcnpgeepdnnok/segoe-ui.woff);
            }

            @font-face {
                font-family: 'SegoeUI_bold_online_security';
                src: url(chrome-extension://llbcnfanfmjhpedaedhbcnpgeepdnnok/segoe-ui-bold.woff);
            }
        </style>
        <style type="text/css">
            @font-face {
                font-family: Roboto;
                src: url("chrome-extension://mcgbeeipkmelnpldkobichboakdfaeon/css/Roboto-Regular.ttf");
            }
        </style>
    @else

        <link href="{{ asset('dashboard-assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
            type="text/css" />
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('dashboard-assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet"
            type="text/css" />
    @stack('styles')
</head>
<!--end::Head-->

<!--begin::Body-->


<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true"
    data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-aside-enabled="true"
    data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true" data-kt-app-aside-push-footer="true"
    class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header d-flex flex-column flex-stack">
                @include('dashboard.layouts.header')
            <!--begin::Separator-->
             <div class="app-header-separator"></div>
            <!--end::Separator-->
        </div>
        <!--end::Header-->
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            @include('dashboard.layouts.sidebar')
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <!--begin::Content-->
                    <div id="kt_app_content" class="app-content flex-column-fluid">
                        @yield('content')

                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Content wrapper-->
                <!--begin::Footer-->
                <div id="kt_app_footer" class="app-footer">
                        @include('dashboard.layouts.footer')
                </div>
                <!--end::Footer-->
            </div>
            <!--end:::Main-->
            <!--begin::aside-->
            <div id="kt_app_aside" class="app-aside flex-column" data-kt-drawer="true" data-kt-drawer-name="app-aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_aside_mobile_toggle">
                {{-- <!--begin::Wrapper-->
                <div id="kt_app_aside_wrapper" class="d-flex flex-column align-items-center hover-scroll-y mt-lg-n3 py-5 py-lg-0 gap-4" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_aside_wrapper" data-kt-scroll-offset="5px">
                    <a href="../../demo39/dist/apps/calendar.html" class="btn btn-icon btn-color-primary bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Calendar" data-bs-custom-class="tooltip-inverse">
                        <i class="ki-outline ki-calendar fs-2x"></i>
                    </a>
                    <a href="../../demo39/dist/account/overview.html" class="btn btn-icon btn-color-warning bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Profile" data-bs-custom-class="tooltip-inverse">
                        <i class="ki-outline ki-address-book fs-2x"></i>
                    </a>
                    <a href="../../demo39/dist/apps/ecommerce/catalog/products.html" class="btn btn-icon btn-color-success bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Messages" data-bs-custom-class="tooltip-inverse">
                        <i class="ki-outline ki-tablet-ok fs-2x"></i>
                    </a>
                    <a href="../../demo39/dist/apps/inbox/listing.html" class="btn btn-icon btn-color-dark bg-hover-body h-45px w-45px flex-shrink-0" data-bs-toggle="tooltip" title="Products" data-bs-custom-class="tooltip-inverse">
                        <i class="ki-outline ki-calendar-add fs-2x"></i>
                    </a>
                </div>
                <!--end::Wrapper--> --}}
            </div>
            <!--end::aside-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-outline ki-arrow-up"></i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "{{ asset('dashboard-assets') }}/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('dashboard-assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('dashboard-assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="{{ asset('dashboard-assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('dashboard-assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('dashboard-assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('js/dashboard/global_scripts.js') }}"></script>
    <script src="{{ asset('js/dashboard/translations.js') }}"></script>
    <script src="{{ asset('js/dashboard/search.in.table.js ') }}"></script>

    <script src="{{ asset('dashboard-assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script>
        document.getElementById('togglePasswordVisibility').addEventListener('click', function () {
            togglePasswordVisibility('password_inp');
            togglePasswordVisibility('password_confirmation_inp');
        });

        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        }
    </script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    @stack('scripts')<!--end::Custom Javascript-->
</body>
<!--end::Body-->

</html>














