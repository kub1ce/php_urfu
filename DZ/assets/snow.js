document.addEventListener('DOMContentLoaded', () => {
	const canvas = document.getElementById('snow');
	if(!canvas) return;

	const ctx = canvas.getContext('2d');
	let w = canvas.width = innerWidth;
	let h = canvas.height = innerHeight;
	const flakes = [];
	const count = Math.round(w / 10);
		for(let i=0;i<count;i++){
				flakes.push({
				x: Math.random()*w,
				y: Math.random()*h,
				r: Math.random()*3+1,
				d: Math.random()*0.5+0.2
			});
	}
	function draw(){
		ctx.clearRect(0,0,w,h);
		ctx.fillStyle = 'rgba(255,255,255,0.9)';
		ctx.beginPath();
		for(let f of flakes){
			ctx.moveTo(f.x, f.y);
			ctx.arc(f.x, f.y, f.r, 0, Math.PI*2);
		}
		ctx.fill();
		update();
		requestAnimationFrame(draw);
	}
	function update(){
		for(let f of flakes){
			f.y += f.d + f.r*0.1;
			f.x += Math.sin(f.y/40) * 0.5;
			if(f.y > h + 10) { f.y = -10; f.x = Math.random()*w; }
		}
	}
	window.addEventListener('resize', () => { w = canvas.width = innerWidth; h = canvas.height = innerHeight; });
	draw();
});
