import Profile from "./Profile"
import SecretMessage from "./SecretMessage"


const name = "aku"

export default function App() {
    return (
        <div className="max-w-4xl mx-auto bg-blue-50">
            <div className="text-gray-400 text-xs p-5 bg-black ">Kirim pesan rahasia ke {name}. {name} tidak akan tau siapa yang mengirim pesan rahasia ini. teerdapat dua pilihan privasi yaitu public dan private. privasi public memungkinkan semua orang dapat melihat pesan rahasia secara rahasia. privasi private hanya memungkinkan {name} saja yang dapat melihat. </div>

            <div className="block md:flex">
                {/* profil */}
                <Profile/>

                {/* serets message */}
                <SecretMessage/>
            </div>
        </div>
    )
}
