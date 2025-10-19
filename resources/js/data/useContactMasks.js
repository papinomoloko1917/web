// Phone mask: +7 (XXX) XXX XX XX
export function formatPhoneMask(raw) {
    let digits = String(raw || "").replace(/\D/g, "");
    if (digits.startsWith("8")) digits = "7" + digits.slice(1);
    if (!digits.startsWith("7")) digits = "7" + digits;
    digits = digits.slice(0, 11);
    const core = digits.slice(1);
    const p1 = core.slice(0, 3);
    const p2 = core.slice(3, 6);
    const p3 = core.slice(6, 8);
    const p4 = core.slice(8, 10);
    let result = "+7";
    result += " (" + p1.padEnd(3, "_") + ")";
    result += " " + (p2 ? p2.padEnd(3, "_") : "___");
    result += " " + (p3 ? p3.padEnd(2, "_") : "__");
    result += " " + (p4 ? p4.padEnd(2, "_") : "__");
    return result;
}

export function isPhoneComplete(masked) {
    return (
        typeof masked === "string" &&
        masked.indexOf("_") === -1 &&
        /\+7 \(\d{3}\) \d{3} \d{2} \d{2}/.test(masked)
    );
}

export function backspacePhoneAtPosition(value, pos) {
    if (!value || pos == null) return { value, pos };
    for (let i = pos - 1; i >= 0; i--) {
        if (/\d|_/.test(value[i])) {
            const arr = value.split("");
            arr[i] = "_";
            return { value: arr.join(""), pos: i };
        }
    }
    return { value, pos };
}

// Date mask: dd.mm.yyyy (text input)
export function formatDateMaskedFromDigits(digits) {
    const only = String(digits || "")
        .replace(/\D/g, "")
        .slice(0, 8);
    const d = only.slice(0, 2);
    const m = only.slice(2, 4);
    const y = only.slice(4, 8);
    let out = "";
    if (d) out += d.padEnd(2, "_");
    if (out.length >= 2) out += ".";
    if (m) out += m.padEnd(2, "_");
    else if (out.length === 3) out += "__";
    if (out.length >= 5) out += ".";
    if (y) out += y.padEnd(4, "_");
    else if (out.length === 6) out += "____";
    return out || "";
}

export function normalizeDateFromMasked(masked) {
    if (typeof masked !== "string") return "";
    const m = masked.match(/^(\d{2})\.(\d{2})\.(\d{4})$/);
    if (!m) return "";
    const [_, dd, mm, yyyy] = m;
    const d = parseInt(dd, 10),
        mth = parseInt(mm, 10),
        y = parseInt(yyyy, 10);
    if (mth < 1 || mth > 12) return "";
    const daysInMonth = new Date(y, mth, 0).getDate();
    if (d < 1 || d > daysInMonth) return "";
    return `${y.toString().padStart(4, "0")}-${mm}-${dd}`;
}

export function isDateMaskedComplete(masked) {
    return /^(\d{2})\.(\d{2})\.(\d{4})$/.test(masked || "");
}
