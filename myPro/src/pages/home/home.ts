import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {IndexPage} from '../index/index'
import {ListPage} from '../list/list'
import {UserCenterPage} from '../user-center/user-center'
import {NotFoundPage} from '../not-found/not-found'

/**
 * Generated class for the HomePage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-home',
  templateUrl: 'home.html',
})
export class HomePage {
  indexPage;
  listPage;
  userCenterPage;
  notFoundPage;


  constructor(public navCtrl: NavController, public navParams: NavParams) {
    this.indexPage = IndexPage;
    this.listPage = ListPage;
    this.userCenterPage = UserCenterPage;
    this.notFoundPage = NotFoundPage;
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad HomePage');
  }

}
