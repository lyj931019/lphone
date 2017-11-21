import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {MyHttpService} from '../../app/utility/service/myhttp.service'
import {DetailPage} from '../detail/detail'

/**
 * Generated class for the IndexPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-index',
  templateUrl: 'index.html',
})
export class IndexPage {
  carouselItems:Array<any> = [];
  newArrivalItems:Array<any> = [];
  floors:any;
  constructor(private myHttp:MyHttpService,public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad IndexPage');
    this.loadData();
  }

  loadData(){
    this.myHttp
    .sendRequest('http://localhost/lphone/data/04_shopmain/getbanner.php')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
        this.carouselItems=result
      }
    })
    this.myHttp
    .sendRequest('http://localhost/lphone/data/04_shopmain/getonefloor.php?key=pc_g')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
        this.newArrivalItems=result;
      }
    })
    this.myHttp
    .sendRequest('http://localhost/lphone/data/04_shopmain/getfloors.php')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
       this.floors=result
      }
    })
  }

  jumpToDetail(index,key){
    //跳转到详情页，同时将产品的id发给detail
    // console.log(this.recommendedItems[index].gid)
    // this.navCtrl.push(
    //   DetailPage,
    //   {id:this.recommendedItems[index].gid}
    //   );
      this.navCtrl.push(
      DetailPage,
      {id:this.floors[key][index].gid}
      );
    }
  

}
