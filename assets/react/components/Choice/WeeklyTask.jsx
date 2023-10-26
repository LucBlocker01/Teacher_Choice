import React, {useEffect, useState} from "react";
import {fetchAllWeeks, fetchMyChoice} from "../../services/api/api";
import Paper from "@mui/material/Paper";
import {Table, TableBody, TableCell, TableContainer, TableHead, TableRow} from "@mui/material";

function WeeklyTask(){
    const [ weeklyTask, setWeeklyTask ] = useState({}) ;

    let objectWeek = [];

    useEffect(() => {
        fetchMyChoice().then((data) => {
            data["hydra:member"].map((choice) => {
                choice.lessonInformation.lessonPlannings.map((lessonPlanning) => {
                    //console.log(lessonPlanning.weekStatus.week.weekNum);
                    var weeknum = lessonPlanning.weekStatus.week.weekNum;
                    var semester = choice.lessonInformation.lesson.subject.semester.name;
                    if (objectWeek[weeknum]){
                        objectWeek[weeknum]["total"] += lessonPlanning.nbHours * choice.nbGroupSelected;
                    } else {
                        objectWeek[weeknum] = { "total": lessonPlanning.nbHours * choice.nbGroupSelected };
                    }

                    setWeeklyTask(objectWeek);
                })
            })
        });
    }, []);

    console.log(weeklyTask);

    return (<>
        <TableContainer sx={{
            display: "flex",
            justifyContent: "flex-start",
            backgroundColor: "secondary.main",
            border: 1,
            marginBottom: 2,
            borderRadius: "5px",
            overflowX: "auto",
            overflowY: "auto",
            maxHeight: "500px",
            borderColor: "primary.main"
        }} component={Paper}>
            <Table sx={{
                minWidth: 800,
            }} size="small" aria-label="simple table">
                <TableHead sx={{
                    backgroundColor: "primary.main",
                    position:"sticky",
                    top: 0,
                }}>
                    <TableRow>

                    </TableRow>
                </TableHead>
                <TableBody>
                    <TableRow>
                        <TableCell>test</TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </TableContainer>
    </>);
}

export default WeeklyTask;