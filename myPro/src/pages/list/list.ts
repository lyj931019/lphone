import { Component } from '@angular/core';

import { NavController, NavParams } from 'ionic-angular';

import {DetailPage} from '../detail/detail';
import {MyHttpService} from '../../app/utility/service/myhttp.service';

@Component({
  selector: 'page-list',
  templateUrl: 'list.html'
})
export class ListPage {
  gameList:Array<any>;
  constructor(private myHttp:MyHttpService,public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad IndexPage');
    this.loadData();
  }
  ionViewWillEnter(){
    this.loadData();
  }

  loadData(){
    this.myHttp
    .sendRequest('http://localhost/lphone/data/06_list/list.php')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
        this.gameList=result.data;
      }
    })
  }

  jumpToDetail(index){
    //跳转到详情页，同时将产品的id发给detail
    console.log(this.gameList[index].gid)
    this.navCtrl.push(
      DetailPage,
      {id:this.gameList[index].gid}
      );
  }

  doRefresh($event){
    console.log(1)
  }
}
