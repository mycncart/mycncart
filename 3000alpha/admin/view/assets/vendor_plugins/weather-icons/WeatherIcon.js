// WeatherIcon.js is released as
// "Creative Commons - Attribution - ShareAlike 3.0".
// 
// http://creativecommons.org/licenses/by-sa/3.0/
// 
// 
// 
// You are free to:
// 
// Share Ñ copy and redistribute the material in any medium or format
// Adapt Ñ remix, transform, and build upon the material for any purpose, even commercially.
// 
// The licensor cannot revoke these freedoms as long as you follow the license terms.
// 
// 
// 
// Under the following terms:
// 
// Attribution Ñ You must give appropriate credit, provide a link to the license, and indicate if changes were made. You may do so in any reasonable manner, but not in any way that suggests the licensor endorses you or your use.
// ShareAlike Ñ If you remix, transform, or build upon the material, you must distribute your contributions under the same license as the original.
// 
// No additional restrictions Ñ You may not apply legal terms or technological measures that legally restrict others from doing anything the license permits.
// 
// 
// 
// Notices:
// 
// You do not have to comply with the license for elements of the material in the public domain or where your use is permitted by an applicable exception or limitation.
// No warranties are given. The license may not give you all of the permissions necessary for your intended use. For example, other rights such as publicity, privacy, or moral rights may limit how you use the material.

"use strict";

var WeatherIcon = (function(){

	function WeatherIcon(container,stroke,shadow) {
	
			this.isPlaying = false;
			this.canvas = new WeatherIcon.Canvas(container);
			this.canvas.setCanvasSize(128,128);
			this.fps = 30;
			this.particlesBorder = 20;
			this.spf = 1000/this.fps;
			this.objects = [];
			this.particles = [];
			this.timer = false;
	
			// fill
			this.canvas.ctx.fillStyle = '#fff';
			
			// stroke
			if (stroke) {
				this.stroke = true;
				this.canvas.ctx.lineWidth = 2;
				this.canvas.ctx.strokeStyle = '#000';
			} else {
				this.stroke = false;
				this.canvas.ctx.strokeStyle = 'transparent';
			}
			
			// shadow
			if(shadow) {
				this.canvas.ctx.shadowOffsetX	= 0;
				this.canvas.ctx.shadowOffsetY	= 0;
				this.canvas.ctx.shadowBlur 		= 5;
				this.canvas.ctx.shadowColor		= "black";
			}		
		};
	

	
	// Point
	WeatherIcon.Canvas = (function(){
		
		// Canvas
		function Canvas(obj,id) {
	
			if (obj) {
				if (obj.nodeName=='CANVAS') {
					this.canvas	= obj;
				} else {
					this.canvas = document.createElement("canvas");
					if(id) this.canvas.id = id;
					obj.appendChild(this.canvas);
		
					// IE
					if (Canvas.ieMode) G_vmlCanvasManager.initElement(this.canvas);
				}
			} else {
				this.canvas = document.createElement("canvas");
				if (Canvas.ieMode) G_vmlCanvasManager.initElement(this.canvas);
			}
		
			// GET CONTEXT
			this.ctx = this.canvas.getContext('2d');
			
		}
	
		Canvas.prototype = {
			setSize:function(w,h) {
				this.setCanvasSize(w,h);
				this.setHtmlSize(w+'px',h+'px');
			},
			
			setCanvasSize:function(w,h) {
				this.canvas.width  = w;
				this.canvas.height = h; 
			},
			
			setHtmlSize:function(w,h) {
			
				this.canvas.style.width  = w;
				this.canvas.style.height = h;	
			},

			drawBox:function(w,h,rad) {
			
				this.ctx.beginPath();
				this.ctx.moveTo(rad, 0);
			
				this.ctx.lineTo(w-rad, 0);
				this.ctx.bezierCurveTo(w, 0, w, 0, w, rad);
			
				this.ctx.lineTo(w, h-rad);
				this.ctx.bezierCurveTo(w, h, w, h, w-rad, h);
			
				this.ctx.lineTo(rad, h);
				this.ctx.bezierCurveTo(0, h, 0, h, 0, h-rad);
			
				this.ctx.lineTo(0, rad);
				this.ctx.bezierCurveTo(0, 0, 0, 0, rad, 0);
			
				this.ctx.fill();
			},

			clear:function(){
				this.ctx.clearRect(0,0,this.canvas.width,this.canvas.height);
			}
		}

		
		Canvas.supported = function() {
			// Make sure we don't execute when canvas isn't supported
			var canvas = document.createElement("canvas");	
			return (canvas.getContext) ? true:false;
		}
	
		
		// Detect internet explorer to load google canvas code (G_vmlCanvasManager)
		var
			rv = -1, // Default value assumes no ie
			ua = navigator.userAgent,
			re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
			if (re.exec(ua) != null) rv = parseFloat( RegExp.$1 );

		Canvas.ieMode = (rv>-1&&rv<9);

	return Canvas;}());
	
	
	// Point
	WeatherIcon.Point = (function(){
	
		function Point(x, y){ this.x = x || 0; this.y = y || 0; };
		Point.prototype.add = function(p){ this.x+=p.x;this.y+=p.y };
		Point.prototype.set = function(x,y){ this.x=x;this.y=y };
		Point.prototype.prod = function(n){ this.x*=n;this.y*=n };
		Point.prototype.clone = function() { return new WeatherIcon.Point(this.x, this.y); };
		Point.prototype.rotate = function(r) {var x = this.x;var y = this.y;this.x = x*r.x-y*r.y;this.y = x*r.y+y*r.x;};
	
	return Point;}());
	
	
	// Circle 
	WeatherIcon.Circle = function( center , r ){ this.center=center;this.r=r };
	
	
	// Prototype
	WeatherIcon.prototype = {
		draw:function(){
			
			var n;
			this.canvas.clear();
			
			n = this.particles.length;
			while(n--) {
				this.particles[n].update(10);
				this.particles[n].draw(this.canvas.ctx);
			}
			
			n = this.objects.length;
			while(n--) {
				this.objects[n].update(10);
				this.objects[n].draw(this.canvas.ctx);
			}
		},
	
		update:function() {
			this.isPlaying = true;
			this.draw();
			this.timer = setTimeout(this.update.bind(this),this.spf);
		},
	
		play:function() {
			this.stop();
			this.update();
		},
		
		stop:function(){
			this.isPlaying=false;
			if (this.timer) {
				clearTimeout(this.timer);
				this.timer = false;
			}
		},
		
		setBody:function(body){
			this.body = body;
		},
		
		setIcon:function(icon){
			this.icon = icon;
		},
		
		toggle:function() {
			this.isPlaying?this.stop():this.play();
		},

		change:function(icon,mode){
			
			this.icon = icon;
			this.setIcon(icon);
			this.setBody(mode===WeatherIcon.NIGHT?WeatherIcon.NIGHT:WeatherIcon.DAY);
			this.build();
			this.draw();
		},

		addRain:function(type){
			type = type==WeatherIcon.LIGHT?WeatherIcon.LIGHT:WeatherIcon.HEAVY;
			var
				speed = 0.2,
				angle = 0.2,
				yo = 60,
				n = WeatherIcon.particles[type].length;
			while(n--) this.particles.push(new WeatherIcon.Drop(WeatherIcon.particles[type][n],speed,angle,yo));
		},
		
		addSnow:function(type){
			type = type==WeatherIcon.LIGHT?WeatherIcon.LIGHT:WeatherIcon.HEAVY;
			var
				speed = 0.2,
				angle = 0.2,
				yo = 60,
				n = WeatherIcon.particles[type].length;
				
			while(n--) this.particles.push(new WeatherIcon.Snow(WeatherIcon.particles[type][n],speed,angle,yo));
		},
		
		addSleet:function(){
			// add rain and snow
			var
				type = WeatherIcon.LIGHT,
				speed = 0.2,
				angle = 0.2,
				yo = 60,
				n = WeatherIcon.particles[type].length;
				
			while(n--) {
				var drop = (n%2) ? new WeatherIcon.Drop(WeatherIcon.particles[type][n],speed,angle,yo):new WeatherIcon.Snow(WeatherIcon.particles[type][n],speed,angle,yo);
				this.particles.push(drop);
			}
		},

		build:function(){
	
			this.objects = [];
			this.particles = [];
	
			switch(this.icon) {
				
				case WeatherIcon.SUN:
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(64,64,30):new WeatherIcon.Moon(64,64,30));
					break;
	
				case WeatherIcon.LIGHTCLOUD:
					this.objects.push(new WeatherIcon.Cloud(80,100,40));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(64,64,30):new WeatherIcon.Moon(64,64,30));
					break;
				
				case WeatherIcon.PARTLYCLOUD:
					this.objects.push(new WeatherIcon.Cloud(68,90,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(64,54,30):new WeatherIcon.Moon(64,54,30));
					break;
	
				case WeatherIcon.CLOUD: 
					this.objects.push(new WeatherIcon.Cloud(90,80,40));
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					break;
	
				case WeatherIcon.LIGHTRAINSUN:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addRain(WeatherIcon.LIGHT);
					break;
	
				case WeatherIcon.SLEETSUN:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addSleet();
					break;
	
				case WeatherIcon.SNOWSUN:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addSnow(WeatherIcon.LIGHT);
					break;
	
				case WeatherIcon.SNOW:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addSnow();
					break;
	
				case WeatherIcon.SNOWTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addSnow(WeatherIcon.LIGHT);
					this.objects.push(new WeatherIcon.Thunder(55,82,0.8));
					break;
	
				case WeatherIcon.THUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.objects.push(new WeatherIcon.Thunder(30,75,0.6));
					this.objects.push(new WeatherIcon.Thunder(60,80,0.7));
					this.objects.push(new WeatherIcon.Thunder(90,75,0.6));
					break;
	
				case WeatherIcon.SLEETSUNTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addSleet();
					this.objects.push(new WeatherIcon.Thunder(95,85,0.7));
					this.objects.push(new WeatherIcon.Thunder(58,88,0.8));
					break;
	
				case WeatherIcon.LIGHTRAINTHUNDERSUN:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addRain(WeatherIcon.LIGHT);
					this.objects.push(new WeatherIcon.Thunder(30,75,0.6));
					this.objects.push(new WeatherIcon.Thunder(58,90,0.7));
					break;
	
				case WeatherIcon.SNOWSUNTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,60,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(40,30,20):new WeatherIcon.Moon(40,30,20));
					this.addSnow(WeatherIcon.LIGHT);
					this.objects.push(new WeatherIcon.Thunder(30,75,0.6));
					this.objects.push(new WeatherIcon.Thunder(58,90,0.7));
					break;
	
				case WeatherIcon.LIGHTRAIN:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addRain(WeatherIcon.LIGHT);
					break;
	
				case WeatherIcon.RAIN:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addRain();
					break;
	
				case WeatherIcon.FOG:
					this.objects.push(new WeatherIcon.Fog(68,90,80));
					this.objects.push(this.body==WeatherIcon.DAY?new WeatherIcon.Sun(64,54,30):new WeatherIcon.Moon(64,54,30));
					break;
	
				case WeatherIcon.LIGHTRAINTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addRain(WeatherIcon.LIGHT);
					this.objects.push(new WeatherIcon.Thunder(30,72,0.7));
					this.objects.push(new WeatherIcon.Thunder(58,88,0.8));
					break;
				
				case WeatherIcon.RAINTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addRain();
					this.objects.push(new WeatherIcon.Thunder(30,72,0.7));
					this.objects.push(new WeatherIcon.Thunder(58,88,0.8));
					break;
	
				case WeatherIcon.SLEETTHUNDER:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addSleet();
					this.objects.push(new WeatherIcon.Thunder(95,85,0.7));
					this.objects.push(new WeatherIcon.Thunder(58,88,0.8));
					break;
	
				case WeatherIcon.EXTREME: // TODO 
				case WeatherIcon.SLEET:
					this.objects.push(new WeatherIcon.Cloud(68,50,80));
					this.addSleet();
					break;
	
			}		
		}
	
	
	};
	
	
	
	// COMPONENTS
	WeatherIcon.Cloud = (function(){
		
		var Cloud = function(xo,yo,w) {
		
				xo=xo?xo:68;
				yo=yo?yo:50;
				w=w?w:80;
		
				var h = w*0.5;
				var center = new WeatherIcon.Point(xo,yo);
				var size = new WeatherIcon.Point(w,h)
				var sizeMed = new WeatherIcon.Point(w>>1,h>>1)
				
				
				
				this.size = size;
				this.po = new WeatherIcon.Point( center.x - sizeMed.x ,  center.y  );
				this.p1 = this.po.clone();
				this.p1.x += size.x;
				
				this.cl = new WeatherIcon.Circle(new WeatherIcon.Point( center.x - sizeMed.x ,  center.y  ),w*0.14);
				this.cr = new WeatherIcon.Circle(new WeatherIcon.Point( center.x + sizeMed.x ,  center.y + w*0.03 ),w*0.1);
				
				this.ca = new WeatherIcon.Circle(new WeatherIcon.Point(center.x - sizeMed.x*0.42 , center.y ),w*0.35);
				this.cb = new WeatherIcon.Circle(new WeatherIcon.Point(center.x + sizeMed.x*0.45 , center.y ),w*0.25);
				this.cc = new WeatherIcon.Circle(new WeatherIcon.Point(center.x - sizeMed.x*0.20 , center.y ),w*0.28);
				
				
				
				this.pi = Math.PI;
				this.pi2 = this.pi/2;
				
				this.p2 = new WeatherIcon.Point( +this.w , this.h );
		
			}
		
		Cloud.prototype = {
			
			update:function(dt) {},
			
			draw:function(ctx) {
		
				// fill
				ctx.beginPath();
				ctx.arc(this.cl.center.x,this.cl.center.y, this.cl.r , 0, 2*this.pi );
				ctx.arc(this.cl.center.x+this.cl.r,this.cl.center.y, this.cl.r , 0, 2*this.pi );
				ctx.arc(this.cc.center.x,this.cc.center.y, this.cc.r , 0 , 2*this.pi );
				ctx.arc(this.ca.center.x,this.ca.center.y, this.ca.r , this.pi , 0 );		
				ctx.arc(this.cb.center.x,this.cb.center.y, this.cb.r , 0 , 2*this.pi );
				ctx.arc(this.cr.center.x,this.cr.center.y, 1.3*this.cr.r , 0, 2*this.pi );
				ctx.closePath();
				ctx.stroke();
				ctx.fill();
			}
			
		};

	return Cloud;}());
	
	
	
	WeatherIcon.Snow = (function(){
	
		var Snow = function(posIni,speed,angle_,yo) {
				
				this.angle = angle_;
				this.speed = speed;
				this.posIni = posIni;
				this.w 	= 3;
				this.dy = this.w*4;
				this.pos = this.posIni.clone();
				this.rot = new WeatherIcon.Point(Math.cos(this.angle),Math.sin(this.angle));
		
				this.v = new WeatherIcon.Point(0,this.speed);
				this.v.rotate(this.rot);
		
				this.po = new WeatherIcon.Point( );
				this.po.add(this.pos);
				
				// reset position
				var dy = this.po.y - yo;
				var m = this.rot.y/this.rot.x;
				
				this.pr = new WeatherIcon.Point( this.po.x+dy*m , yo );
		
				this.angle = Math.PI/3.5;
				this.angle2 = 2*this.angle;
				this.r = (this.w>>1);
				
			};
		
		
		Snow.prototype = {
			
			reset:function(){
				this.po.set(0,0);
				this.po.add(this.pr);
			},
		
		
			update:function(dt) {
			
				var dPos = new WeatherIcon.Point(this.v.x*dt,this.v.y*dt);
				this.po.add(dPos);
				if (this.po.y>128) { this.reset(); }
			},
			
			draw:function(ctx) {
			
				ctx.beginPath();
				ctx.arc(this.po.x,this.po.y + this.dy , this.w , 0, 6.28 );
				ctx.closePath();
				ctx.stroke();
				ctx.fill();
			
			/*
				ctx.beginPath();
				ctx.save();
				ctx.translate( this.po.x,this.po.y );
				ctx.rect(-this.r , 0 , this.w , 1);
				ctx.rotate(-this.angle);
				ctx.rect(-this.r , 0 , this.w , 1);
				ctx.rotate(this.angle2);
				ctx.rect(-this.r , 0 , this.w , 1);
				ctx.restore();
				ctx.closePath();
				ctx.stroke();
				ctx.fill();
			*/
			}
		}
	
	
	return Snow;}());
	
	
	WeatherIcon.Drop = (function(){
		
		var Drop = function(posIni,speed,angle_,yo) {
				
				this.angle = angle_;
				this.speed = speed;
				this.posIni = posIni;
				this.isFreeze = false;
		
				this.elongation = 2;
				this.w 	= 10;
				this.h = this.w*this.elongation;
				
				this.pos = this.posIni.clone();
				this.rot = new WeatherIcon.Point(Math.cos(this.angle),Math.sin(this.angle));
		
				this.v = new WeatherIcon.Point(0,this.speed);
				this.v.rotate(this.rot);
		
				this.po = new WeatherIcon.Point( );
				this.p1 = new WeatherIcon.Point( -this.w , this.h );
				this.p2 = new WeatherIcon.Point( +this.w , this.h );
		
				this.p1.rotate(this.rot);
				this.p2.rotate(this.rot);
				this.po.add(this.pos);
				this.p1.add(this.pos);
				this.p2.add(this.pos);
				
				// reset position
				var dy = this.po.y - yo;
				var m = this.rot.y/this.rot.x;
				var xo = this.po.x+dy*m;
				//_('debug').innerHTML += this.angle+'>'+Math.cos(this.angle)+","+Math.sin(this.angle)+"<br>";
				this.pr = new WeatherIcon.Point( xo , yo );
				
			};
		
		
		Drop.prototype = {
		
			freeze:function(){
				this.isFreeze = true;
				this.angle = Math.PI/3.5;
				this.r = (this.w>>1);
			},
		
		
			reset:function(){
		
				this.po.set(0,0);
				this.p1.set( -this.w , this.h );
				this.p2.set( +this.w , this.h );
		
				this.p1.rotate(this.rot);
				this.p2.rotate(this.rot);
		
				this.po.add(this.pr);
				this.p1.add(this.pr);
				this.p2.add(this.pr);		
			},
		
		
			update:function(dt) {
		
				var dPos = new WeatherIcon.Point(this.v.x*dt,this.v.y*dt);
		
				this.po.add(dPos);
				this.p1.add(dPos);
				this.p2.add(dPos);
				
				if (this.po.y>128) { this.reset(); }
			},
			
			
			draw:function(ctx) {
		
				ctx.beginPath();
				
				if (this.isFreeze) {
		
					
					ctx.save();
					ctx.translate( this.po.x,this.po.y );
					ctx.rect(-this.r , 0 , this.w , 1);
					ctx.restore();
		
					ctx.save();
					ctx.translate( this.po.x,this.po.y );
					ctx.rotate(this.angle);
					ctx.rect(-this.r , 0 , this.w , 1);
					ctx.restore();
		
					ctx.save();
					ctx.translate( this.po.x,this.po.y );
					ctx.rotate(-this.angle);
					ctx.rect(-this.r , 0 , this.w , 1);
					ctx.restore();
		
					//ctx.lineTo(this.po.x - this.w , this.po.y);
				} else {
					ctx.moveTo(this.po.x,this.po.y);
					ctx.bezierCurveTo(this.p1.x,this.p1.y,this.p2.x,this.p2.y,this.po.x,this.po.y+1e-5); // +1e-5 debug chrome bezierCurveTo bug
				}
				ctx.closePath();
				ctx.stroke();
				ctx.fill();
			}
			
		}
		
	return Drop;}());

	
	WeatherIcon.Thunder = (function(){
		
		function Thunder(x,y,s){
			this.so = s||1;
			this.s = this.so;
			this.x = x;
			this.y = y;
			this.ti = 500*Math.random();
			
			this.p = [];
			this.n = Thunder.points.length;
		};
		
		
		Thunder.prototype.update = function() {
		
			if (!this.t) {
				this.t = new Date().getTime() + this.ti;
				this.s = this.so;
				return;
			}
			
			var t = new Date().getTime();
			var dt = t - this.t - this.ti;
			
			this.s = 0;
			
			if (dt>2000)		{this.s = 0;this.t = t;}
			else if (dt>1000)	this.s = this.so;
			else if (dt>700)	this.s = (Math.random()<0.5)?this.so:0;
		}
		
		
		Thunder.prototype.draw = function(ctx) {
			
			ctx.beginPath();
			ctx.save();
			ctx.translate( this.x , this.y );
			ctx.scale(this.s,this.s);
			
			ctx.moveTo(Thunder.points[0].x,Thunder.points[0].y);
			var n = this.n;
			while (n--) ctx.lineTo(Thunder.points[n].x,Thunder.points[n].y);
			ctx.stroke();
		
			ctx.fill();
			ctx.restore();
		}
		
		
		Thunder.size = { w:30 , h:45 }
		Thunder.points = [{x:0,y:0},{x:0,y:22},{x:13,y:20},{x:3,y:43},{x:28,y:15},{x:12,y:13},{x:21,y:0}];
		
		
	return Thunder;}());
	
	
	WeatherIcon.Sun = (function(){
	
		var Sun = function(xo,yo,ri,re) {
		
				xo = xo?xo:64;
				yo = yo?yo:64;
				ri = ri?ri:20;
				re = re?re:ri*1.25;
				
				var center = new WeatherIcon.Point(xo,yo);
				
				this.rotation = { val:0 , inc:0.001 };
				this.center = center;
				this.points = [];
				this.pointsExt = [];
				
				var n = 20;
				var angle = 0;
				var dAngle = Math.PI/n;
				
				while(n--){
					
					var x = ri*Math.cos(angle);
					var y = ri*Math.sin(angle);
					this.points.push(new WeatherIcon.Point(x,y));
		
					angle += dAngle;
		
					var x = re*Math.cos(angle);
					var y = re*Math.sin(angle);
					this.pointsExt.push(new WeatherIcon.Point(x,y));
		
					angle += dAngle
				}
			};

		Sun.prototype = {
			
			update:function(dt) {},
			
			draw:function(ctx) {
			
				var nMax = this.points.length;
				var n = 0;
				
				ctx.save();
				ctx.translate( this.center.x , this.center.y );
				ctx.rotate( this.rotation.val+=this.rotation.inc );
				ctx.beginPath();
				ctx.moveTo(this.pointsExt[nMax-1].x,this.pointsExt[nMax-1].y);
				for (n=0;n<nMax;n++) ctx.quadraticCurveTo(this.points[n].x,this.points[n].y,this.pointsExt[n].x,this.pointsExt[n].y);
				
				ctx.stroke();
				ctx.fill();
				ctx.restore();
			}
		}
	
	return Sun;}());
	
	
	WeatherIcon.Fog = (function(){

		var Fog = function() { this.angle = 0; }
		
		Fog.PI2 = Math.PI*2;
		
		Fog.prototype = {
			
			update:function(dt) { this.angle += 0.01;},
			
			draw:function(ctx) {
		
				var dx;
		
				// fill
				dx = 0.2*Math.cos(this.angle)
				ctx.beginPath();
				ctx.save();
				ctx.translate( 85,62 );
				ctx.scale(13,1);
				ctx.arc(dx,0, 2 , 0, Fog.PI2 );
				ctx.closePath();
				ctx.restore();
				ctx.stroke();
				ctx.fill();
		
				dx = 0.2*Math.cos(this.angle+0.5)
				ctx.beginPath();
				ctx.save();
				ctx.translate( 40,70 );
				ctx.scale(6,0.5);
				ctx.arc(dx,0, 5 , 0, Fog.PI2 );
				ctx.closePath();
				ctx.restore();
				ctx.stroke();
				ctx.fill();
		
				dx = 0.3*Math.cos(this.angle)
				ctx.beginPath();
				ctx.save();
				ctx.translate( 80,80 );
				ctx.scale(6,0.5);
				ctx.arc(dx,0, 7 , 0, Fog.PI2 );
				ctx.closePath();
				ctx.restore();
				ctx.stroke();
				ctx.fill();
		
				dx = 0.4*Math.cos(this.angle+0.9)
				ctx.beginPath();
				ctx.save();
				ctx.translate( 56,92 );
				ctx.scale(10,1);
				ctx.arc(dx,0, 5 , 0, Fog.PI2 );
				ctx.closePath();
				ctx.restore();
				ctx.stroke();
				ctx.fill();
				
				dx = 0.2*Math.cos(this.angle)
				ctx.beginPath();
				ctx.save();
				ctx.translate( 100,104 );
				ctx.scale(7,1);
				ctx.arc(dx,0, 3 , 0, Fog.PI2 );
				ctx.closePath();
				ctx.restore();
				ctx.stroke();
				ctx.fill();
				}
			}
						
	return Fog;}());
	
	

	WeatherIcon.Moon = (function(){

		function Moon(x,y,r){ this.x = x||0; this.y = y||0; this.r=r||20;
			this.rotDirection = 1;
			this.rotAngle = 0;
			this.angleMax = 10*Math.PI/180;
		};

		Moon.prototype = {
	
			update:function() {
	
				if(this.rotAngle>this.angleMax) this.rotDirection = -1;
				else if(this.rotAngle<-this.angleMax)this.rotDirection = 1;
		
				this.rotAngle += 0.002*this.rotDirection;
			},

			draw:function(ctx) {

				ctx.save();
				ctx.translate( this.x , this.y );
				ctx.rotate( -0.6 + this.rotAngle );
			
				var a = 0.31*Math.PI;
				ctx.beginPath();
				ctx.arc(0,0, this.r , a , -a );
				ctx.arc(this.r,0, this.r , Math.PI+a , Math.PI-a , true);
				ctx.stroke();
				ctx.fill();
			
				ctx.restore();
			}
		};

	return Moon;}());

	
	// PARAMETERS
	WeatherIcon.particles = {
		heavy:[
			new WeatherIcon.Point(22,96),
			new WeatherIcon.Point(22,116),
			new WeatherIcon.Point(36,71),
			new WeatherIcon.Point(47,95),
			new WeatherIcon.Point(47,115),
			new WeatherIcon.Point(57,64),
			new WeatherIcon.Point(66,88),
			new WeatherIcon.Point(66,108),
			new WeatherIcon.Point(78,61),
			new WeatherIcon.Point(83,94),
			new WeatherIcon.Point(83,114),
			new WeatherIcon.Point(95,72),
			new WeatherIcon.Point(104,88),
			new WeatherIcon.Point(104,108)
		],light:[
			new WeatherIcon.Point(22,96),
			new WeatherIcon.Point(36,71),
			new WeatherIcon.Point(47,110),
			new WeatherIcon.Point(66,88),
			new WeatherIcon.Point(78,61),
			new WeatherIcon.Point(83,110),
			new WeatherIcon.Point(104,88),
		]};
	
	
	
	
	// day / night /  todo midnight soon ... ( todo c95 )
	WeatherIcon.DAY = 'Sun';
	WeatherIcon.NIGHT = 'Moon';
	
	// precipitation ammount
	WeatherIcon.LIGHT = 'light';
	WeatherIcon.HEAVY = 'heavy';

	// icons list	
	WeatherIcon.SUN	= 1;					// SUN
	WeatherIcon.LIGHTCLOUD = 2;				// SUN , SMALL CLOUD
	WeatherIcon.PARTLYCLOUD = 3;			// SUN , BIG CLOUD
	WeatherIcon.CLOUD = 4;					// BIG CLOUD , SMALL CLOUD
	WeatherIcon.LIGHTRAINSUN = 5;			// SUN , BIG CLOUD , LIGHT RAIN
	WeatherIcon.LIGHTRAINTHUNDERSUN = 6;	// SUN , BIG CLOUD , LIGHT RAIN , THUNDER
	WeatherIcon.SLEETSUN = 7;				// SUN , BIG CLOUD , LIGHT RAIN , SNOW
	WeatherIcon.SNOWSUN = 8;				// SUN , BIG CLOUD , SNOW
	WeatherIcon.LIGHTRAIN = 9;				// BIG CLOUD , LIGHT RAIN
	WeatherIcon.RAIN = 10;					// BIG CLOUD , HARD RAIN
	WeatherIcon.RAINTHUNDER = 11;			// BIG CLOUD , HARD RAIN , THUNDER
	WeatherIcon.SLEET = 12;					// BIG CLOUD , RAIN , SNOW
	WeatherIcon.SNOW = 13;					// BIG CLOUD , SNOW
	WeatherIcon.SNOWTHUNDER = 14;			// BIG CLOUD , SNOW , THUNDER
	WeatherIcon.FOG = 15;					// SUN , FOG
	WeatherIcon.SLEETSUNTHUNDER = 20		// SUN , SLEET , THUNDER
	WeatherIcon.SNOWSUNTHUNDER = 21;		// BIG CLOUD, SUN , SNOW , 2x THUNDER
	WeatherIcon.LIGHTRAINTHUNDER = 22;		// BIG CLOUD , lIGHT RAIN , THUNDER
	WeatherIcon.SLEETTHUNDER = 23;			// TODO
	
	// dark days (todo c95)
	WeatherIcon.DARKDAY_SUN = 16;
	WeatherIcon.DARKDAY_LIGHTCLOUD = 17;
	WeatherIcon.DARKDAY_LIGHTRAINSUN = 18;
	WeatherIcon.DARKDAY_SNOWSUN = 19;
	
	// extreme conditions
	WeatherIcon.THUNDER = 50;				// BIG CLOUD , 3 x THUNDER
	WeatherIcon.EXTREME = 99;				// TODO
	
	
	// STATIC FUNCTIONS
	WeatherIcon.add = function(dom,icon,param) {
	
		if(typeof dom=='string') dom = document.getElementById(dom);
	
		if (param==undefined) param = {};
			
		var weatherIcon = new WeatherIcon(dom,param.stroke===false?false:true,param.shadow===true?true:false);
		
		weatherIcon.setIcon(icon);
		weatherIcon.setBody(param.mode===WeatherIcon.NIGHT?WeatherIcon.NIGHT:WeatherIcon.DAY);
		weatherIcon.build();
		weatherIcon.draw();
		
		if(param.animated===true) weatherIcon.update();
		
		return weatherIcon;
	};


return WeatherIcon;}());









