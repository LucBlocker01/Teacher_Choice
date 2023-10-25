import React, {useEffect, useState} from "react";
import {fetchAllWeeks, fetchMyChoice} from "../services/api/api";

function WeeklyTask(){
    const [ weeklyTask, setWeeklyTask ] = useState({}) ;

    let objectWeek = [];

    useEffect(() => {
        fetchAllWeeks().then((data) => {
            data["hydra:member"].map((week) => {
                objectWeek[week.weekNum] = 0;
            });
            setWeeklyTask(objectWeek);
        } )
    }, []);

    console.log(weeklyTask);

    useEffect(() => {
        fetchMyChoice().then((data) => {
            data["hydra:member"].map((choice) => {
                choice.lessonInformation.lessonPlannings.map((lessonPlanning) => {

                })
            })
        });
    }, []);

    return (<>

    </>);
}

export default WeeklyTask;