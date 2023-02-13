<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="{{load_asset('front/img/favicon.png')}}" />
	<title>{{$application_name}} | {{$application_long_name}}</title>
	<style type="text/css">
		* { margin:0; padding:0; }
		html, body { width:100%; height:100%; }
		canvas { display:block;background-color: #2C001D; }
	</style>
</head>
<body>
<canvas id="main"></canvas>
<script type="text/javascript">
	(function(){
		var canvas=document.getElementById('main');
		var ctx=canvas.getContext('2d');
		var initial_width=0;
		var initial_height=0;
		//helper
		function random_between(min,max){
			return (Math.round(Math.random()*(max-min)))+min;
		}
		//object generator
		function cropper(rad_div){
			var crp={
				radius:0,
				onResize:function(){
					this.radius=canvas.width<canvas.height?canvas.width*rad_div:canvas.height*rad_div;
				},
				crop: function(){
					ctx.beginPath();
					ctx.arc(0,0,this.radius,0,Math.PI*2,false);
					ctx.closePath();
					ctx.clip();
					ctx.clearRect(-this.radius, -this.radius, this.radius*2, this.radius*2);
				}
			};
			crp.onResize();
			return crp;
		}
		function croppedCircle(crp,rad_div,_color,_speed,initial_rotation){
			var circle={
				h:0,
				radius:0,
				color: _color,
				speed: _speed,
				rotation: initial_rotation,
				cropper:crp,
				onResize:function(){
					this.radius=canvas.width<canvas.height?canvas.width*rad_div:canvas.height*rad_div;
					this.h=this.cropper.radius;
				},
				draw:function(){
					ctx.save();
					ctx.fillStyle=this.color;
					ctx.rotate(this.rotation);
					ctx.translate(0,this.h);
					this.rotation+=this.speed;
					ctx.beginPath();
					ctx.arc(0,0,this.radius,0,Math.PI*2,false);
					ctx.fill();
					ctx.restore();
				}
			};
			circle.onResize();
			return circle;
		}
		//generate obj
		var crp=cropper(0.3);
		var circles=[];
		var num_circle=20;
		for (var i = 0; i < num_circle; i++) {
			var r=random_between(1,10)*0.02;
			var speed=(9*0.02-r)*0.05;
			var circle=croppedCircle(crp,r,'rgba(142,46,32,0.25)',speed,Math.PI*2/num_circle*i);
			circles.push(circle);
		}
		var text={
			text:'Coming Soon',
			color: 'white',
			font: '30px Arial',
			incr:0,
			draw: function(){
				ctx.save();
				ctx.textAlign = "center";
				ctx.fillStyle = this.color;
				ctx.font = this.font;
				ctx.fillText(this.text,0,-Math.sin(Math.PI/180*this.incr++)*5);
				ctx.restore();
			}
		};
		window.addEventListener('resize',resize,false);
		function resize(){
			canvas.width = window.innerWidth;
			canvas.height = window.innerHeight;
			crp.onResize();
			for (var i = circles.length - 1; i >= 0; i--) {
				circles[i].onResize();
			}
		}
		resize();
		function draw(){
			window.requestAnimationFrame(draw);
			ctx.clearRect(0,0,canvas.width,canvas.height);
			ctx.save();
			ctx.translate(canvas.width/2,canvas.height/2);
			for (var i = circles.length - 1; i >= 0; i--) {
				circles[i].draw();
			}
			crp.crop();
			text.draw();
			ctx.restore();
		}
		draw();
	})();
</script>
</body>
</html>
