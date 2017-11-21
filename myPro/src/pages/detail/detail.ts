import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {MyHttpService} from '../../app/utility/service/myhttp.service'
import {LoginPage} from '../login/login'
import {NotFoundPage} from '../not-found/not-found'
import {CartPage} from '../cart/cart'
/**
 * Generated class for the DetailPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-detail',
  templateUrl: 'detail.html',
})
export class DetailPage {
  //存储图片信息的数组
  picList:Array<any> = [];
  //保存所有的详情数据
  detailInfo:any;
  gLabels:any;
  gTerraces:any;
  gSpecs:any;
  gPQR:any;
  //保存id
  gnameId:number;
  constructor(private myHttp:MyHttpService,public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad DetailPage');
    //解析index传递来的参数
    let myId:number = parseInt(this.navParams.get('id'));
    console.log(myId);
    this.gnameId = myId;
    //向服务器要id为myId的详情信息
    this.loadData(myId);
  }
  ionViewWillEnter(){
    console.log('ionViewDidLoad DetailPage');
    let myId:number = parseInt(this.navParams.get('id'));
    this.gnameId = myId;
    this.loadData(myId);
  }

  loadData(id:number){
    this.myHttp
    .sendRequest("http://localhost/lphone/data/05_detail/getdetail.php?gid="+id)
    .subscribe((result:any)=>{
      console.log(result);
      if(result){
        // console.log(true);
        this.detailInfo=result.details[0];
        this.picList=result.imgs;
        this.gLabels=result.labels
        this.gTerraces=result.terraces
        this.gSpecs=result.specs;
        if(result.phone_qr){
          this.gPQR=result.phone_qr[0]
        }
      }
    })

  }

  jumpToNotFound(){
    this.navCtrl.push(NotFoundPage);
  }
 

  //添加到购物车

}
