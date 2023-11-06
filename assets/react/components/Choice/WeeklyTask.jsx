import React, {useEffect, useState} from "react";
import {fetchAllWeeks, fetchMyChoice} from "../../services/api/api";
import { BarChart } from '@mui/x-charts/BarChart';

function WeeklyTask(){
    const [ weeks, setWeeks ] = useState([]);
    const [ S1Data, setS1Data ] = useState([0]);
    const [ S2Data, setS2Data ] = useState([0]);
    const [ S3Data, setS3Data ] = useState([0]);
    const [ S4Data, setS4Data ] = useState([0]);
    const [ S5Data, setS5Data ] = useState([0]);
    const [ S6Data, setS6Data ] = useState([0]);

    var weeksList = [];
    var s1data = [];
    var s2data = [];
    var s3data = [];
    var s4data = [];
    var s5data = [];
    var s6data = [];
    for (let ele = 0; ele < 35; ele++ ){
        s1data.push(0)
        s2data.push(0)
        s3data.push(0)
        s4data.push(0)
        s5data.push(0)
        s6data.push(0)
    }

    useEffect(() => {
        fetchAllWeeks().then((weeks) => {
            weeks["hydra:member"].map((week) => {
                if (week.lessonPlannings.length !== 0){
                    weeksList.push(week.weekNum)
                }
            })

            const part2 = weeksList.slice(0, 20);
            const part1 = weeksList.slice(20, weeksList.length)

            weeksList = part1.concat(part2);

            setWeeks(weeksList)
        })
    }, []);

    useEffect(()=>{
        fetchMyChoice().then((choices) => {
            choices["hydra:member"].map((choice) => {
                choice.lessonInformation.lessonPlannings.map((plann) => {
                    var nWeek = plann.week.weekNum;
                    var nbHours = plann.nbHours;
                    var semester = choice.lessonInformation.lesson.subject.semester.name;
                    var nbGroups = choice.nbGroupSelected;

                    switch (semester){
                        case "S1":
                            s1data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                        case "S2":
                            s2data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                        case "S3":
                            s3data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                        case "S4":
                            s4data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                        case "S5":
                            s5data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                        case "S6":
                            s6data[weeks.indexOf(nWeek)] += nbHours * nbGroups
                            break
                    }
                });
            });
            setS1Data(s1data);
            setS2Data(s2data);
            setS3Data(s3data);
            setS4Data(s4data);
            setS5Data(s5data);
            setS6Data(s6data);
        })
    },[weeks]);

    console.log(weeks);
    console.log(S1Data, S2Data, S3Data, S4Data, S5Data, S6Data);

    return (<>
        <BarChart
            width={900}
            height={300}
            series={[
                {data: S1Data, label: "S1", stack: 'total'},
                {data: S2Data, label: "S2", stack: 'total'},
                {data: S3Data, label: "S3", stack: 'total'},
                {data: S4Data, label: "S4", stack: 'total'},
                {data: S5Data, label: "S5", stack: 'total'},
                {data: S6Data, label: "S6", stack: 'total'}
            ]}
            xAxis={[{ data: weeks, scaleType: 'band'}]}
         >
        </BarChart>
    </>);
}

export default WeeklyTask;