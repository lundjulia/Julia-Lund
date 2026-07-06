import UIKit

enum ImageStoreError: Error {
    case encodingFailed
}

/// Saves and loads clothing photos as JPEG files under Documents/Images.
/// SwiftData models only ever hold the file name, never image data.
enum ImageStore {
    private static var imagesDirectory: URL {
        let documents = FileManager.default.urls(for: .documentDirectory, in: .userDomainMask)[0]
        let directory = documents.appendingPathComponent("Images", isDirectory: true)
        if !FileManager.default.fileExists(atPath: directory.path) {
            try? FileManager.default.createDirectory(at: directory, withIntermediateDirectories: true)
        }
        return directory
    }

    static func save(_ image: UIImage) throws -> String {
        guard let data = image.jpegData(compressionQuality: 0.8) else {
            throw ImageStoreError.encodingFailed
        }
        let fileName = "\(UUID().uuidString).jpg"
        let url = imagesDirectory.appendingPathComponent(fileName)
        try data.write(to: url)
        return fileName
    }

    static func load(fileName: String) -> UIImage? {
        let url = imagesDirectory.appendingPathComponent(fileName)
        guard let data = try? Data(contentsOf: url) else { return nil }
        return UIImage(data: data)
    }

    static func delete(fileName: String) {
        let url = imagesDirectory.appendingPathComponent(fileName)
        try? FileManager.default.removeItem(at: url)
    }
}
