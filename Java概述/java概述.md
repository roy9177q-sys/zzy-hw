
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
具體化的方式不同，接口通過實現類，抽象通過繼承
抽象類單繼承，接口多實現

父類中的構造器，在創建子類對象的時候會自動調用，非抽象類，調用構造器來創建對象，創建父類對象抽象類，調用父類構造器，但不會創建對象。

4運算符
邏輯運算符只能用于boolean類型的數據運算，判斷boolean數據之間的邏輯關係，包括與、或、非
與：＆＆（短路與） 、＆
或：｜｜ （短路或）、｜
非：！
與：A和B,A和B都為ture,結果為ture,否則為false
或：A和B,有一個都為ture,結果為ture,否則為false
非：相反
與和短路與的區別，運算邏輯完全一致，短路與的性能更高
或和短路或的區別，運算邏輯完全一致，短路或的性能更高
表達式A＆表達式B
同時運算表達式A和表達式B，對結果進行邏輯與運算
表達式A＆＆表達式B
優先運算表達式A如果結果為false，則不需要運算表達式B
表達式A|表達式B
同時運算表達式A和表達式B，對結果進行邏輯與運算
表達式A | |表達式B
優先運算表達式A，如果結果為true ，則不需要運算表達式B

```
public class test{
public static void main(String[]args){
	int num1 = 10;
	int num2 = 11;
	Systeam.out.println(num1++ == num2 )&&(++num1 ==num2);
	Systeam.out.println(num1);
	}
}
```
位運算符
對表達式已二進制為單位進行運算，將數據全部換成二進制再進行運算
十進制和二進制的轉換：
十進制轉二進制：
目標數除二，若能除盡，該標記為零，若除不盡，則該標記做一，在往已此類推
10轉二進制1010
17轉二進制10001
二進制轉十進制:
從目標數最右側開始，本位的數值乘以本位的權重(2的幾位的數減一次方)，
把每一位的乘積相加
&(按位與)、｜(按位或)、＾(按位異或)、<<(左移)、>>(右移)
A&B:每一組的數字一一對應，若都為1，則該標記做1，否則為0
A｜B:每一組的數字一一對應，只要一個為1，則該標記做1，否則為0
A＾B:每一組的數字一一對應，相同為0，不同為1
A<<B:A* 2的B次方，2<<3 2* 2的3次方＝16
A>>B:A除以2的B次方，2>>3 2/2的3次方＝0
以上為筆試喜歡考的
 位運算符>邏輯運算符>算數運算符

2流程控制
if-else switch-case for while do-while foreach

if-else 和 switch-case
區別：
1.if-else可以進行等值判斷，也可以進行邏輯判斷，switch-case只能進行等值判斷
2.switch-case代碼結構更清晰易懂，if-else結構相對不清晰
四種循環
for
```
for(int i = 0;i<100;i++)
```
while 
do-while
foreach(針對集合便歷的循環)增強行for循環
循環四要素：
初始化循環變量
```
while(i<100){
Systeam.out.primtln(i);
i++
}
```
```
int i=0;
do{
Systeam.out.primtln(i);
i++;
}while (i<100);
```
while和do-while的區別
while需要先判斷循環條件，再進行循環體
do-while第一次不需要判斷，直接執行循環體，
循環條件
循環體
asdasdasd
dasa
