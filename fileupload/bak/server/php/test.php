<div id="outer" style="background:#099">  
 2         click outer  
 3         <p id="inner" style="background:#9C0">click inner</p>  
 4         <br>  
 5     </div>  
 6       
 7     <script type="text/javascript">  
 8     function G(id){  
 9         return document.getElementById(id);      
10     }  
11     function addEvent(obj, ev, handler){  
12         if(window.attachEvent){  
13             obj.attachEvent("on" + ev, handler);  
14         }else if(window.addEventListener){   
15             obj.addEventListener(ev, handler, false);  
16         }  
17     }  
18     function test(e){  
19         alert("e.target.tagName : " + e.target.tagName + "\n e.currentTarget.tagName : " + e.currentTarget.tagName);  
20     }  
21     var outer = G("outer");  
22     var inner = G("inner");  
23     //addEvent(inner, "click", test);  
24     addEvent(outer, "click", test);  
25     </script>  
