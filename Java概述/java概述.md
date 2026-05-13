
1.java概述
99.9％項目都基於Web
Web服務器端Java第一語言
Spring框架
 
 
 2.開發版本
 JDK21
 企業仍然是JDK8
 分布式事務只支持JDK8
 MySQL 8 
 MySQL主流
 java基礎打基礎單機
 java Wed 用java做wed開發 servlet java EE
 做項目很重要


3.JDK
JDK:java Development Kit java開發工具包
JRE java Runtime Environment Java 運行環境
只需要訊行java項目必須安裝JRE
開發java項目必須安裝JDK包含JRE
Java不是解釋型語言
HTML JS
Java源代碼>字節碼>機械碼
所以Java需要先編譯？
為了實現一大特性 一次編譯 到處運行跨平台
同一套代碼可以在不同的操作系統上運行
如何跨平台？
透過編譯的方式
Java源代碼篇一成字節碼文件
Test.java->Test.calss>-運行
java源代碼編譯成字節碼的命令是什麼
```
javac Test.java 
```
 java字節碼運行的命令是什麼？
```
 java Test
```
 都可以審略由開幫工具幫忙我們完成

4.變量
為什麼我要使用變量？變量是解決我們什麼問題？
存儲地址的問題
數據都是在內存中進行存取，存在一個問題？
程序會隨機分配內存區域
如何解決這個問題？
使用變量
變量就是為了解決內存地址很難記憶的問題
相當於過了地址一個門牌 取數據時叫出變量就好


01-變量 
聲明變量的數據類型和變量名
java有多少數據類型？
8種基本數據類型
無數種
開發者可以自訂義數據類型
java有兩大類數據類型
 基本數據類型（不是對象,可以推過包裝改造成對象
 引用數據類型（對象,JDK類庫
 Java開發中使用的對象有三種來源
  JDK類庫String Data integer 
  第三方類庫 框架Application SpringBootApplication
  組件 工具 框架
  生態
  JDK->基於JDK類庫
  自定義的類
變量的值
```
int i =1;
String str = new String("hello world");
```
基本數據類型和引用類型在內存中的區別
所有的變量都是存儲在內存中的，無論是基本數據類型還是引用類型


基本數據類型 
數值類型：byte short int long float double 
非數值類型：char boolean
byte 空間：一個字節

數據類型的轉換

基本數據類型的轉換
自動轉換
強制轉換
```
public class Test {
public static void main(String[]args){
Studend studend =new Studend();
Person person = new Person();
//自動類型轉換
person = studend;
//強制轉換類型
student = (Student) person;
	}
}
```
盡量不使用強制類型轉換 因為存在數據精度損失的隱患
```
double num =10.5;
int i =(int)num;
```
byte->short->int->long->float->double
從小轉大
引用數據類型的轉換繼承
貓是動物 對的
動物是貓 不一定 

實現類和接口也可以進行類型轉換，因為接口和實現類本質上也是父類和子類的繼承關係
接口就是父類，實現類就是子類
接口是由抽象類別演變而來的
一個類中包含抽象方法
抽象父類
```
public abstract class Test1 {
public abstract void test();
}
```
非抽象子類
```
public class Test2 extends Test1{
@Override
publci void test(){
	}
}
```
抽象父類可以優化成接口
```
public interface Test1{
public abstract void test();
}
```
非抽象子類變成實現類
```
public class Test2 implements Test1{
@Override
publci void test(){
	}
}

```
接口不能強制轉換類型，因為接口無法實例化

接口和抽象類的區別
關鍵字不同
抽象類中可以包含非抽象方法 接口全部是抽象方法
