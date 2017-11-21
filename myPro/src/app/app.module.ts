import { BrowserModule } from '@angular/platform-browser';
import { NgModule, ErrorHandler } from '@angular/core';
import { IonicApp, IonicModule, IonicErrorHandler } from 'ionic-angular';
import { HttpModule} from '@angular/http'
import { MyApp } from './app.component';

import { HelloIonicPage } from '../pages/hello-ionic/hello-ionic';
import { ItemDetailsPage } from '../pages/item-details/item-details';
import { ListPage } from '../pages/list/list';
import {HomePage} from '../pages/home/home'
import {IndexPage} from '../pages/index/index'
import {CartPage} from '../pages/cart/cart'
import {UserCenterPage} from '../pages/user-center/user-center'
import {NotFoundPage} from '../pages/not-found/not-found'
import {DetailPage} from '../pages/detail/detail'
import {LoginPage} from '../pages/login/login'

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import {MyHttpService} 
from './utility/service/myhttp.service'


@NgModule({
  declarations: [
    MyApp,
    HelloIonicPage,
    ItemDetailsPage,
    ListPage,
    HomePage,
    IndexPage,
    CartPage,
    UserCenterPage,
    NotFoundPage,
    DetailPage,
    LoginPage
  ],
  imports: [
    BrowserModule,
    HttpModule,
    IonicModule.forRoot(MyApp),
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HelloIonicPage,
    ItemDetailsPage,
    ListPage,
    HomePage,
    IndexPage,
    CartPage,
    UserCenterPage,
    NotFoundPage,
    DetailPage,
    LoginPage
  ],
  providers: [
    StatusBar,
    SplashScreen,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    MyHttpService
  ]
})
export class AppModule {}
