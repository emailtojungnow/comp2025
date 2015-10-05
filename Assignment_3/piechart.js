/* CANVAS 2D PIE CHART
 * Args:
 * [1] chartId: 'yourCanvasElementId'
 * [2] colours: ['#f00', '#0f0', '#00f'] 
 *     permissible colour specs:
 *     - red
 *     - #ff0000
 *     - #f00
 *     - rgb(255,0,0)
 *     - rgba(255,0,0,0.5) (alpha range: 0.0-1.0)
 * [3] angles: [60, 90, 210] (360 deg overall) 
 * [4] colorCount: total number of color choice submission.
 * Note: colours and angles arrays must have identical length.
 */

function piechart(chartId, colours, angles, colorCount) {
	
	var canvas  = document.getElementById(chartId);
	var context = canvas.getContext("2d");
	var x = Math.floor(canvas.width  / 2);
	var y = Math.floor(canvas.height / 2);
	var startAngle = 0.0;


	for (var i = 0; i < colours.length; i++) {
		context.save();
		drawSegment(colours[i], angles[i], colorCount[i]);
		context.restore();
		
	}

	function drawSegment(colour, angle, colorCount) {
		var endAngle = startAngle + parseFloat(angle) * Math.PI / 180;
		context.beginPath();
		context.moveTo(x, y);
		context.arc(x, y, (x > y ? y : x), startAngle, endAngle, false);
		context.fillStyle = colour;
		context.fill();
		drawSegmentLabel(angle, colorCount);
		context.closePath();
		
		startAngle = endAngle;	
	}

	function drawSegmentLabel(angle, colorCount) {
	   context.translate(x, y);
	   context.rotate(startAngle);
	   var dx = Math.floor(canvas.width * 0.5) - 80;
	   var dy = Math.floor(canvas.height * 0.05);
	   context.textAlign = "right";
	   var fontSize = Math.floor(canvas.height / 25);
	   context.font = 6 + "pt Helvetica";
	   context.fillStyle = "white";
	   context.fillText(colorCount, dx, dy);
	}
}