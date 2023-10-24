import React, {useEffect, useState} from "react";
import '../../../public/CSS/app.css'
import {fetchMyChoice, fetchTeachers} from "../services/api/api";
import ChoiceItem from "./ChoiceItem";

function AdminPanel() {
    const [teachers, setTeachers] = useState();

    useEffect(() => {
        fetchTeachers().then((data) => {
            setTeachers(data["hydra:member"].map((user) => {
                return [user['id'], user['firstname']+ ' ' + user['lastname']];
            }));
        })
    }, []);

    const [value, setValue] = useState("");

    function handleChange(event) {
        console.log(teachers)
        setValue(event.target.value);
    }
    console.log(teachers)
    return (
        <div className="searchBar">
            <div className="inputSearch">
                <input type="text" value={value} onChange={handleChange} />
                <button onClick={() => console.log(value)}>
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
                            <li onClick={() => setValue(element[1])} key={index}>
                                {element[1]}
                            </li>
                        ))}
            </ul>
        </div>
    );
}

export default AdminPanel;