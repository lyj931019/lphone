import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import {MyHttpService} from '../../app/utility/service/myhttp.service';
import {LoginPage} from '../login/login';
import {IndexPage} from '../index/index';
import {NotFoundPage} from '../not-found/not-found'
/**
 * Generated class for the UserCenterPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-user-center',
  templateUrl: 'user-center.html',
})
export class UserCenterPage {

  userId:any=-1;
  userInfo:any;

  constructor(public myHttp:MyHttpService,public navCtrl: NavController, public navParams: NavParams) {
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad UserCenterPage');
  }
  ionViewWillEnter(){
    console.log("i am coming");
    this.checkUserLogin();
  }

  userLogout(){
    this.myHttp
    .sendRequest('http://localhost/lphone/data/logout.php')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
        if(result<0){
           this.myHttp.showToast('注销成功');
           this.navCtrl.push(LoginPage);
           this.userInfo=null;
           this.userId=-1;
        }
      }
    })
  }

  jumpToNotFound(){
    this.navCtrl.push(NotFoundPage)
  }

  checkUserLogin(){
    this.myHttp
    .sendRequest('http://localhost/lphone/data/session.php')
    .subscribe((result:any)=>{
      console.log(result);
      if(result){//如果服务器端返回的result有有效值，保存数据
        if(result<0){
          this.navCtrl.push(LoginPage);
        }else{
          this.userId=result;
          console.log(this.userId);
          this.myHttp
            .sendRequest("http://localhost/lphone/data/03_login/getuserinfo.php")
            .subscribe((res:any)=>{
              console.log(res);
              if(res){
                this.userInfo=res;
                console.log(this.userInfo)
              }
            })
        }
      }
    })
  }
}
