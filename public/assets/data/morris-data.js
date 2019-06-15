$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010-03',
            itouch: 2
        }, {
            period: '2010-04',
            itouch: 21
        }, {
            period: '2010-05',
            itouch: 25
        }, {
            period: '2010-06',
            itouch: 5
        }, {
            period: '2010-07',
            itouch: 22
        }, {
            period: '2010-08',
            itouch: 18
        }, {
            period: '2010-09',
            itouch: 15
        }, {
            period: '2010-10',
            itouch: 51
        }, {
            period: '2010-11',
            itouch: 20
        }, {
            period: '2010-12',
            itouch: 17
        }],
        xkey: 'period',
        ykeys: ['itouch'],
        labels: ['iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "hijab mantab",
            value: 12
        }, {
            label: "hijab terbaru",
            value: 30
        }, {
            label: "hijab nissa sabyan",
            value: 20
        }, {
            label: "hijab korea",
            value: 50
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });
    
});
