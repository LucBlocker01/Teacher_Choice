import React, {useEffect, useState} from "react";
import {fetchAllWeeks, fetchMyChoice} from "../../services/api/api";
import { BarChart } from '@mui/x-charts/BarChart';

function WeeklyTask(){
    const [ weeks, setWeeks ] = useState([]);
    const [ S1Data, setS1Data ] = useState([]);
    const [ S2Data, setS2Data ] = useState([]);
    const [ S3Data, setS3Data ] = useState([]);
    const [ S4Data, setS4Data ] = useState([]);
    const [ S5Data, setS5Data ] = useState([]);
    const [ S6Data, setS6Data ] = useState([]);


    useEffect(() => {
        fetchAllWeeks().then((weeks) => {
            setWeeks(
                weeks["hydra:member"].map((week) => {
                    if (week.lessonPlannings.length !== 0){
                        return week.weekNum
                    }
                })
            );
        })
    }, []);

    console.log(weeks);

    // un tableau par semestre et un tableau avec toutes les semaines

    return (<>

    </>);
}

export default WeeklyTask;