import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

// import 'framework7/framework7-bundle.min.css';
// var $ = Dom7;
import Framework7 from 'framework7/framework7-bundle';

// import './store.js';
import Dexie from 'dexie';
//var db = new Dexie('MyDatabase');


import routes from "./routes.js";
// Routing.setData(RoutingData);

import {DbUtilities} from './js/lib/dixieDatabase.js';
import '@tabler/core';
import '@tabler/core/dist/css/tabler.min.css';


