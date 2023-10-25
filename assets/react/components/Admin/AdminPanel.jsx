import React, {useEffect, useState} from "react";
import '../../../../public/CSS/app.css'
import {fetchMyChoice, fetchTeachers} from "../../services/api/api";
import ChoiceItem from "../ChoiceItem";
import {element} from "prop-types";
import TeacherChoiceList from "./TeacherChoiceList";

function AdminPanel() {
    const [teachers, setTeachers] = useState();
    const [currentTeacher, setCurrentTeacher] = useState();
    const [value, setValue] = useState("");
    const [id, setId] = useState();
    const [display, setDisplay] = useState("none");

    useEffect(() => {
        fetchTeachers().then((data) => {
            setTeachers(data["hydra:member"].map((user) => {
                return [user['id'], user['firstname']+ ' ' + user['lastname']];
            }));
        })
    }, []);

    function handleChange(event) {
        setValue(event.target.value);
    }

    function setValues(id, value) {
        setValue(value);
        setId(id);
    }

    function HandleClick(id){
        console.log(`HandleClick, id: ${id}`);
        setCurrentTeacher(<TeacherChoiceList id={id}/>);

    }
    return (
        <div className="searchBar">
            <div className="inputSearch">
                <input type="text" value={value} onChange={handleChange} />
                <button onClick={() => HandleClick(id)}>
                    <span className="material-symbols-outlined">search</span>
                </button>
            </div>
            <ul>
                {value &&
                    teachers
                        .filter((element) =>
                            element[1].toLowerCase().includes(value.toLowerCase())
                        )
                        .map((element, index) => (
                            <li onClick={() => setValues(element[0], element[1])} key={index} >
                                {element[1]}
                            </li>
                        ))}
            </ul>
            {currentTeacher}
        </div>
    );
}

export default AdminPanel;