<p align="center">
  <img src="https://raw.githubusercontent.com/notiflix/Notiflix/master/github-assets/welcome-to-notiflix.gif" width="480" height="auto" alt="Notiflix">
</p>

<p align="center">
  <img src="https://raw.githubusercontent.com/notiflix/Notiflix/master/github-assets/notiflix-logo.svg?sanitize=true" width="240" height="80" alt="Notiflix">
</p>

## Notiflix | a JavaScript library for client-side non-blocking notifications.
Notiflix is a JavaScript library for client-side non-blocking notifications, popup boxes, loading indicators, and more to that makes your web projects much better. [*](# "zero-dependency")

#### Current Version
2.1.3 [*](https://github.com/notiflix/Notiflix/blob/master/ReleaseNotes.md "Release Notes")

#### Website
https://www.notiflix.com

#### Documentation
https://www.notiflix.com/documentation

#### Demo
- **Notiflix Notify** => https://www.notiflix.com/#Notify
- **Notiflix Report** => https://www.notiflix.com/#Report
- **Notiflix Confirm** => https://www.notiflix.com/#Confirm
- **Notiflix Loading** => https://www.notiflix.com/#Loading
- **Notiflix Block** => https://www.notiflix.com/#Block

---------

### (A) Install and Import
(React, Angular, NextJS...)

Install

[npm](https://www.npmjs.com/package/notiflix)

```js
npm i notiflix
```

[yarn](https://yarnpkg.com/en/package/notiflix)

```js
yarn add notiflix
```

Import

```jsx
// all modules
import Notiflix from "notiflix";

// one by one
import { Notify, Report, Confirm, Loading, Block } from "notiflix";
```

---------

### (B) Add an HTML

##### CSS and JS
```html
<link rel="stylesheet" href="notiflix-2.1.3.min.css" />

<script src="notiflix-2.1.3.min.js"></script>
```

##### or only JS (All in One - Internal CSS)
```html
<script src="notiflix-aio-2.1.3.min.js"></script>
```


---------

### Usage

1- Notify Module

```js
/*
* @param1 {string}: Required, message text in String format.
* @param2 {function}: Optional, callback function when the notification element clicked.
*/

Notiflix.Notify.Success('Success message text');

Notiflix.Notify.Failure('Failure message text');

Notiflix.Notify.Warning('Warning message text');

Notiflix.Notify.Info('Info message text');

// e.g. with a callback
Notiflix.Notify.Success(
  'Click Me', 
  function(){
    // callback
  },
);
```

--_--_----_--_----_--_----_--_----_--_----_--_--


2- Report Module

```js
/*
* @param1 {string}: Required, title text in String format.
* @param2 {string}: Required, message text in String format.
* @param3 {string}: Required, button text in String format.
* @param4 {function}: Optional, callback function when the button element clicked.
*/

Notiflix.Report.Success('Title', 'Message', 'Button Text');

Notiflix.Report.Failure('Title', 'Message', 'Button Text');

Notiflix.Report.Warning('Title', 'Message', 'Button Text');

Notiflix.Report.Info('Title', 'Message', 'Button Text');

// e.g. with a callback
Notiflix.Report.Success(
  'Title',
  'Message',
  'Button Text',
  function(){
    // callback
  },
);
```

--_--_----_--_----_--_----_--_----_--_----_--_--


3- Confirm Module

```js
/*
* @param1 {string}: Required, title text in String format.
* @param2 {string}: Required, message text in String format.
* @param3 {string}: Required, ok button text in String format.
* @param4 {string}: Optional, cancel button text in String format.
* @param5 {function}: Optional, callback function when the ok button element clicked.
* @param6 {function}: Optional, callback function when the cancel button element clicked.
*/

Notiflix.Confirm.Show('Title', 'Message', 'Ok Button Text', 'Cancel Button Text');

// e.g. with callback
Notiflix.Confirm.Show(
  'Title',
  'Message',
  'Ok Button Text',
  'Cancel Button Text',

  // ok button callback
  function(){
    // codes...
  },

  // cancel button callback
  function(){
    // codes...
  },
);
```

--_--_----_--_----_--_----_--_----_--_----_--_--


4- Loading Module

```js
/* 
* Only Loading Indicator
*/
Notiflix.Loading.Standard();
Notiflix.Loading.Hourglass();
Notiflix.Loading.Circle();
Notiflix.Loading.Arrows();
Notiflix.Loading.Dots();
Notiflix.Loading.Pulse();

/* 
* Loading Indicator with a message
* @param1 {string}: Optional, message text in String format.
*/
Notiflix.Loading.Standard('Loading...');

/* 
* Change the message text anytime
* @param1 {string}: Required, message text in String format.
*/
Notiflix.Loading.Change('Loading %20');

/* 
* Remove immediately
*/
Notiflix.Loading.Remove();

/* 
* Remove after delay - e.g. 600ms
* @param1 {number}: Required, number as millisecond.
*/
Notiflix.Loading.Remove(600);


// Custom Loading Indicator: Init a custom SVG Icon
Notiflix.Loading.Init({
  customSvgUrl: 'https://www.notiflix.com/dir/icon.svg',
  svgSize: '80px',
  // etc...
});

// Custom Loading Indicator: Use with custom SVG Icon
Notiflix.Loading.Custom();

// Custom Loading Indicator: Use with custom SVG Icon and a message
Notiflix.Loading.Custom('Loading...');
```

--_--_----_--_----_--_----_--_----_--_----_--_--


5- Block Module

Notiflix Block module can be used to block or unblock elements to prevents users actions during the process (AJAX etc.) without locking the browser or the other elements.

Block:
```js
/*
* @param1 {string}: Required, Select the element(s) to block. (ID or Class)
* @param2 {string}: Optional, Can also be added a message.
*/

// Only indicator
Notiflix.Block.Standard('.element');
Notiflix.Block.Hourglass('.element');
Notiflix.Block.Circle('.element');
Notiflix.Block.Arrows('.element');
Notiflix.Block.Dots('.element');
Notiflix.Block.Pulse('.element');

// With a message
Notiflix.Block.Standard('.selector', 'Loading...');
```


Unblock:
```js
/*
* @param1 {string}: Required, Select the element(s) to unblock. (ID or Class)
* @param2 {number}: Optional, Unblock after a delay.
*/

// Unblock selected element(s) immediately
Notiflix.Block.Remove('.selector');

// Unblock selected element(s) after a delay (e.g. 600 milliseconds)
Notiflix.Block.Remove('.selector', 600);
```

--_--_----_--_----_--_----_--_----_--_----_--_--


### Initialize (optional)

`Notiflix.*.Init` function can be used if wanted to be used with custom settings.

```js
// Notify
Notiflix.Notify.Init({});

// Report
Notiflix.Report.Init({});

// Confirm
Notiflix.Confirm.Init({});

// Loading
Notiflix.Loading.Init({});

// Block
Notiflix.Block.Init({});


// e.g. Initialize the Notify Module with some options
Notiflix.Notify.Init({
  width: '280px',
  position: 'right-top',
  distance: '10px',
  opacity: 1,
  // ...
});
```

--_--_----_--_----_--_----_--_----_--_----_--_--


### Merge (optional)

`Notiflix.*.Merge` function can be used to deeply extend the `Init` function for a specific page or event.

```js
// e.g. Merge the Notify Module initialize function with some new options
Notiflix.Notify.Merge({
  width: '300px',
  // ...
});
```


---------
---------
---------


#### Notiflix Notify Module: Default Options

```js
Notiflix.Notify.Init({
  width: '280px',
  position: 'right-top', // 'right-top' - 'right-bottom' - 'left-top' - 'left-bottom'
  distance: '10px',
  opacity: 1,
  borderRadius: '5px',
  rtl: false,
  timeout: 3000,
  messageMaxLength: 110,
  backOverlay: false,
  backOverlayColor: 'rgba(0,0,0,0.5)',
  plainText: true,
  showOnlyTheLastOne: false,
  clickToClose: false,

  ID: 'NotiflixNotify',
  className: 'notiflix-notify',
  zindex: 4001,
  useGoogleFont: true,
  fontFamily: 'Quicksand',
  fontSize: '13px',
  cssAnimation: true,
  cssAnimationDuration: 400,
  cssAnimationStyle: 'fade', // 'fade' - 'zoom' - 'from-right' - 'from-top' - 'from-bottom' - 'from-left'
  closeButton: false,
  useIcon: true,
  useFontAwesome: false,
  fontAwesomeIconStyle: 'basic', // 'basic' - 'shadow'
  fontAwesomeIconSize: '34px',

  success: {
    background: '#32c682',
    textColor: '#fff',
    childClassName: 'success',
    notiflixIconColor: 'rgba(0,0,0,0.2)',
    fontAwesomeClassName: 'fas fa-check-circle',
    fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
  },

  failure: {
    background: '#ff5549',
    textColor: '#fff',
    childClassName: 'failure',
    notiflixIconColor: 'rgba(0,0,0,0.2)',
    fontAwesomeClassName: 'fas fa-times-circle',
    fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
  },

  warning: {
    background: '#eebf31',
    textColor: '#fff',
    childClassName: 'warning',
    notiflixIconColor: 'rgba(0,0,0,0.2)',
    fontAwesomeClassName: 'fas fa-exclamation-circle',
    fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
  },

  info: {
    background: '#26c0d3',
    textColor: '#fff',
    childClassName: 'info',
    notiflixIconColor: 'rgba(0,0,0,0.2)',
    fontAwesomeClassName: 'fas fa-info-circle',
    fontAwesomeIconColor: 'rgba(0,0,0,0.2)',
  },
});
```

---------

#### Notiflix Report Module: Default Options

```js
Notiflix.Report.Init({
  className: 'notiflix-report',
  width: '320px',
  backgroundColor: '#f8f8f8',
  borderRadius: '25px',
  rtl: false,
  zindex: 4002,
  backOverlay: true,
  backOverlayColor: 'rgba(0, 0, 0, 0.5)',
  useGoogleFont: true,
  fontFamily: 'Quicksand',
  svgSize: '110px',
  plainText: true,
  titleFontSize: '16px',
  titleMaxLength: 34,
  messageFontSize: '13px',
  messageMaxLength: 400,
  buttonFontSize: '14px',
  buttonMaxLength: 34,
  cssAnimation: true,
  cssAnimationDuration: 360,
  cssAnimationStyle: 'fade', // 'fade' - 'zoom'

  success: {
    svgColor: '#32c682',
    titleColor: '#1e1e1e',
    messageColor: '#242424',
    buttonBackground: '#32c682',
    buttonColor: '#fff',
  },

  failure: {
    svgColor: '#ff5549',
    titleColor: '#1e1e1e',
    messageColor: '#242424',
    buttonBackground: '#ff5549',
    buttonColor: '#fff',
  },

  warning: {
    svgColor: '#eebf31',
    titleColor: '#1e1e1e',
    messageColor: '#242424',
    buttonBackground: '#eebf31',
    buttonColor: '#fff',
  },

  info: {
    svgColor: '#26c0d3',
    titleColor: '#1e1e1e',
    messageColor: '#242424',
    buttonBackground: '#26c0d3',
    buttonColor: '#fff',
  },
});
```

---------

#### Notiflix Confirm Module: Default Options

```js
Notiflix.Confirm.Init({
  className: 'notiflix-confirm',
  width: '300px',
  zindex: 4003,
  position: 'center', // 'center' - 'center-top' -  'right-top' - 'right-bottom' - 'left-top' - 'left-bottom'
  distance: '10px',
  backgroundColor: '#f8f8f8',
  borderRadius: '25px',
  backOverlay: true,
  backOverlayColor: 'rgba(0,0,0,0.5)',
  rtl: false,
  useGoogleFont: true,
  fontFamily: 'Quicksand',
  cssAnimation: true,
  cssAnimationStyle: 'fade', // 'zoom' - 'fade'
  cssAnimationDuration: 300,
  plainText: true,

  titleColor: '#32c682',
  titleFontSize: '16px',
  titleMaxLength: 34,

  messageColor: '#1e1e1e',
  messageFontSize: '14px',
  messageMaxLength: 110,

  buttonsFontSize: '15px',
  buttonsMaxLength: 34,
  okButtonColor: '#f8f8f8',
  okButtonBackground: '#32c682',
  cancelButtonColor: '#f8f8f8',
  cancelButtonBackground: '#a9a9a9',
});
```

---------

#### Notiflix Loading Module: Default Options

```js
Notiflix.Loading.Init({
  className: 'notiflix-loading',
  zindex: 4000,
  backgroundColor: 'rgba(0,0,0,0.8)',
  rtl: false,
  useGoogleFont: true,
  fontFamily: 'Quicksand',
  cssAnimation: true,
  cssAnimationDuration: 400,
  clickToClose: false,
  customSvgUrl: null,
  svgSize: '80px',
  svgColor: '#32c682',
  messageID: 'NotiflixLoadingMessage',
  messageFontSize: '15px',
  messageMaxLength: 34,
  messageColor: '#dcdcdc',
});
```


---------


#### Notiflix Block Module: Default Options

```js
Notiflix.Block.Init({
  querySelectorLimit: 200,
  className: 'notiflix-block',
  position: 'absolute',
  zindex: 1000,
  backgroundColor: 'rgba(255,255,255,0.9)',
  rtl: false,
  useGoogleFont: true,
  fontFamily: 'Quicksand',
  cssAnimation: true,
  cssAnimationDuration: 300,
  svgSize: '45px',
  svgColor: '#383838',
  messageFontSize: '14px',
  messageMaxLength: 34,
  messageColor: '#383838',
});
```

---------
---------
---------

#### Copyright
Copyright © 2020 Notiflix

#### License
MIT license - https://opensource.org/licenses/MIT
