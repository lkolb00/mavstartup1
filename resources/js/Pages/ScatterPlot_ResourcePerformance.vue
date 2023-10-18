<script setup>
import { ref } from 'vue';
import * as d3 from 'd3';
import NavBar from "@/Components/NavBar.vue";
const fetchedData = ref([]);

fetch("/api/SchoolSummary")
    .then(response => response.json())
    .then(data => {
        fetchedData.value = data;
        populateYearDropdown();
        updateScatterPlot(+d3.select("#yearSelector").node().value);
    });

const populateYearDropdown = () => {
    const years = [...new Set(fetchedData.value.map(d => d.year))];
    d3.select("#yearSelector")
        .selectAll("option")
        .data(years)
        .enter().append("option")
        .attr("value", d => d)
        .text(d => d);
};

d3.select("#yearSelector").on("change", function() {
    updateScatterPlot(+this.value);
});

const updateScatterPlot = (year) => {
    const filteredData = fetchedData.value.filter(d => d.year === year);

    const svg = d3.select("#scatterplot");
    svg.selectAll('*').remove();

    const margin = {top: 20, right: 20, bottom: 50, left: 70};
    const width = +svg.attr("width") - margin.left - margin.right;
    const height = +svg.attr("height") - margin.top - margin.bottom;

    const xValue = d => d.instructors_per_thousand_student;
    const yValue = d => d.graddegree_perhundredgradstudent;

    const xScale = d3.scaleLinear()
        .domain([0, d3.max(fetchedData.value, xValue) + 10])
        .range([0, width]);

    const yScale = d3.scaleLinear()
        .domain([0, d3.max(fetchedData.value, yValue) + 10])
        .range([height, 0]);

    const g = svg.append('g').attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

    // Tooltips
    const tooltip = d3.select("body").append("div")
        .attr("class", "tooltip")
        .style("opacity", 0);

    const crossVertical = svg.append('line')
        .style('stroke', 'red')
        .attr('y1', 0)


    const crossHorizontal = svg.append('line')
        .style('stroke', 'red')
        .attr('x1', 0)


    g.selectAll('circle')
        .data(filteredData)
        .enter().append('circle')
        .attr('cx', d => xScale(xValue(d)))
        .attr('cy', d => yScale(yValue(d)))
        .attr('r', 3)
        .attr("stroke", "steelblue")
        .attr("stroke-width", 3)
        .on("mouseover", function(event, d) {
            const [x, y] = d3.pointer(event, svg.node());
            tooltip.transition()
                .duration(200)
                .style("opacity", .9);
            tooltip.html("Name: " + d.school_name + "<br/>Year: " + d.year +  "<br/> Instructors/1000 Students: " + xValue(d) + "<br/> Grad Degrees/100 Students: " + yValue(d))
                .style("left", (x + 55) + "px")
                .style("top", (y + 90) + "px");
            crossVertical
                .attr('x1', x)
                .attr('x2', x)
                .attr('y1', 0)
                .attr('y2', height)
                .attr('pointer-events', 'none');
            crossHorizontal
                .attr('y1', y)
                .attr('y2', y)
                .attr('x1', 0)
                .attr('x2', width)
                .attr('pointer-events', 'none');
        })
        .on("mouseout", function(d) {
            crossVertical.attr('y1', 0).attr('y2', 0);
            crossHorizontal.attr('x1', 0).attr('x2', 0);
            tooltip.transition()
                .duration(500)
                .style("opacity", 0);
        })


    // Add the X Axis
    g.append("g")
        .attr("transform", "translate(0," + height + ")")
        .call(d3.axisBottom(xScale));

    // Add the Y Axis
    g.append("g")
        .call(d3.axisLeft(yScale));

    // X-axis label
    svg.append("text")
        .attr("transform",
            "translate(" + (width/2) + " ," +
            (height + margin.top + 40) + ")")
        .style("text-anchor", "middle")
        .text("Instructors per Thousand Students");

    // Y-axis label
    svg.append("text")
        .attr("transform", "rotate(-90)")
        .attr("y", 0 - margin.left + 90)
        .attr("x",0 - (height / 2))
        .attr("dy", "1em")
        .style("text-anchor", "middle")
        .text("Graduate Degrees per Hundred Graduate Students")

    d3.select("#yearSelector").on("change", function() {
        updateScatterPlot(+this.value);
    });
};

</script>

<template>
<NavBar />
    <div class="year_selector">
        <v-label>Select Year: </v-label>
        <select id="yearSelector">

        </select>
    </div>

    <div class="chart_section">
        <svg id="scatterplot" width="800" height="500"></svg>

    </div>
</template>

<style>
    .year_selector{
        margin-top: 150px;
        margin-left: 250px;
    }
    .chart_section{
        margin-top: 10px;
        margin-left: 250px;
    }
    .tooltip {
        position: absolute;
        width: 200px;
        text-align: center;
        padding: 10px;
        font: 12px sans-serif;
        background: #d0cece;
        border: 0px;
        border-radius: 8px;
        pointer-events: none;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
</style>
