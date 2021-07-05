export default function Messages() {
    return (<>
    <div className="px-5 py-3">
        <div>
            <span className="text-blue-900 font-semibold">Seseorang</span> <span className="font-thin text-xs text-blue-400">{ new Date().toLocaleDateString() }</span>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. A, expedita reiciendis exercitationem est quaerat sit dicta quod vitae nihil, alias distinctio saepe necessitatibus. Cumque pariatur illo quis molestias harum facere?</p>
        </div>
        <div className="border-t border-b border-blue-300 py-3">
            <strong>balasan</strong>
            <p className="text-gray-500">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium omnis rerum dolore possimus architecto est unde nihil perferendis blanditiis harum aperiam provident asperiores pariatur animi, numquam facilis voluptatibus, dolores officia.</p>
        </div>
        <div className="py-3">
            <textarea name="balasan" rows="2" placeholder="balasan..." className="w-full p-3 border border-blue-600 rounded-md"></textarea>
            <button className="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-sm">balas</button>
        </div>
    </div>
    </>)
}
