import Foundation

enum Category: String, Codable, CaseIterable, Identifiable {
    case top, bottom, shoes, outerwear

    var id: String { rawValue }
    var displayName: String { rawValue.capitalized }
}

enum Style: String, Codable, CaseIterable, Identifiable {
    case casual, classic, sporty, formal, minimalist

    var id: String { rawValue }
    var displayName: String { rawValue.capitalized }
}

enum Status: String, Codable, CaseIterable, Identifiable {
    case active, archived

    var id: String { rawValue }
    var displayName: String { rawValue.capitalized }
}
