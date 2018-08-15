export default {
    name: "a4printtable",
    template: `
	<div class="printarea">
		<!-- <div class="page A4" style="width:210mm;height: 296mm;overflow: hidden;position: relative;box-sizing: border-box;page-break-after: always;background: white;box-shadow: 0 0.5mm 2mm rgba(0,0,0,.3);margin: 2.5mm;"> -->
			<table border="1" style="width:90%;border:1px;">
				<thead>
					<tr>
						<th v-for="col in cols" >{{col.label}}</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="item in items" >
						<td v-for="k in Object.keys(item)" >{{item[k]}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- </div> -->
	</div>
	`,
    data() {
        return {
            items: [],
            cols: []
        };
    },
    props: {
        // items: {
        //     type: Array,
        //     default: []
        // },
        // cols: {
        //     type: Array,
        //     default: []
        // }
    }
};